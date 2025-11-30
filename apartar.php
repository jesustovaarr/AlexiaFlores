<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/apartado.php');
require_once(__DIR__ . '/models/detalle_apartado.php');
require_once(__DIR__ . '/models/producto.php');
require_once(__DIR__ . '/models/cliente.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['validado']) || !$_SESSION['validado']) {
    $_SESSION['alerta'] = ['mensaje' => 'Necesitas iniciar sesión para apartar productos.', 'tipo' => 'danger'];
    header('Location: registrarse.php');
    exit();
}

if (empty($_SESSION['carrito'])) {
    header('Location: carrito.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['fecha_limite_apartado']) || empty($_POST['hora_limite_apartado'])) {
    $_SESSION['alerta'] = ['mensaje' => 'Por favor, selecciona una fecha y hora límite para tu apartado.', 'tipo' => 'warning'];
    header('Location: carrito.php');
    exit();
}

$apartadoModel = new Apartado();
$detalleApartadoModel = new DetalleApartado();
$productoModel = new Producto();
$clienteModel = new Cliente();

$db_connection = $apartadoModel->getDB();
$detalleApartadoModel->setDB($db_connection);
$productoModel->setDB($db_connection);
$clienteModel->setDB($db_connection);

try {
    $cliente = $clienteModel->getClientePorCorreo($_SESSION['correo']);
    if (!$cliente) throw new Exception("No se pudo encontrar la información del cliente.");
    
    $fecha_limite_str = str_replace('/', '-', $_POST['fecha_limite_apartado']) . ' ' . $_POST['hora_limite_apartado'] . ':00';
    $fecha_limite = date('Y-m-d H:i:s', strtotime($fecha_limite_str));

    $total_apartado = array_reduce($_SESSION['carrito'], function ($total, $item) {
        return $total + ($item['precio'] * $item['cantidad']);
    }, 0);

    $db_connection->beginTransaction();

    $datos_grupo = [
        'id_cliente' => $cliente['id_cliente'],
        'fecha_limite' => $fecha_limite,
        'total_apartado' => $total_apartado,
        'id_estado_apartado' => 2 // Estado: Apartado y Pendiente de Pago
    ];
    $id_apartado_nuevo = $apartadoModel->create($datos_grupo);
    if (!$id_apartado_nuevo) throw new Exception("No se pudo crear el grupo de apartado.");

    foreach ($_SESSION['carrito'] as $id_producto => $item) {
        $productoModel->actualizarStock($id_producto, -$item['cantidad']);
        
        $datos_detalle = [
            'id_apartado' => $id_apartado_nuevo,
            'id_producto' => $id_producto,
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio']
        ];
        $detalleApartadoModel->create($datos_detalle);
    }

    $db_connection->commit();

    unset($_SESSION['carrito']);
    $_SESSION['alerta'] = ['mensaje' => '¡Tus productos han sido apartados con éxito!', 'tipo' => 'success'];
    header('Location: cliente.php?action=apartados');
    exit();

} catch (Exception $e) {
    if ($db_connection->inTransaction()) {
        $db_connection->rollBack();
    }
    $_SESSION['alerta'] = ['mensaje' => 'Error al procesar el apartado: ' . $e->getMessage(), 'tipo' => 'danger'];
    header('Location: carrito.php');
    exit();
}
?>