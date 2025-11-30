<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/models/pedido.php';
require_once __DIR__ . '/models/detalle_pedido.php';
require_once __DIR__ . '/models/producto.php';
require_once __DIR__ . '/models/cliente.php';
require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
    exit;
}

if (!isset($_SESSION['validado']) || !$_SESSION['validado']) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado.']);
    exit;
}

if (empty($_SESSION['carrito'])) {
    echo json_encode(['status' => 'error', 'message' => 'El carrito está vacío.']);
    exit;
}

$pedidoModel = new Pedido();
$detallePedidoModel = new DetallePedido();
$productoModel = new Producto();
$clienteModel = new Cliente();

$db_connection = $pedidoModel->getDB();
$detallePedidoModel->setDB($db_connection);
$productoModel->setDB($db_connection);
$clienteModel->setDB($db_connection);

try {
    $db_connection -> beginTransaction();

    $cliente = $clienteModel -> getClientePorCorreo($_SESSION['correo']);
    $costo_envio = 20.00;

    $total_pedido = array_reduce($_SESSION['carrito'], function ($total, $item) {
        return $total + ($item['precio'] * $item['cantidad']);
    }, $costo_envio);

    $datos_pedido = [
        'id_cliente' => $cliente['id_cliente'],
        'total_pedido' => $total_pedido,
        'id_estado_pedido' => 1,
        'id_metodo_pago' => 2,
    ];
    $id_pedido_nuevo = $pedidoModel->create($datos_pedido);

    $items_mercadopago = [];
    foreach ($_SESSION['carrito'] as $id_producto => $item) {
        $productoModel->actualizarStock($id_producto, -$item['cantidad']);

        $datos_detalle = [
            'id_pedido' => $id_pedido_nuevo,
            'id_producto' => $id_producto,
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio'],
        ];
        $detallePedidoModel->create($datos_detalle);

        $items_mercadopago[] = [
            "title" => $item['producto'],
            "quantity" => (int)$item['cantidad'],
            "unit_price" => (float)$item['precio']
        ];
    }
    $items_mercadopago[] = ["title" => "Costo de Envío", "quantity" => 1, "unit_price" => $costo_envio];

    MercadoPagoConfig::setAccessToken(ACCESSTOKEN);
    $preferenceClient = new PreferenceClient();
    $preference = $preferenceClient->create([
        "items" => $items_mercadopago,
        "payer" => [
            "email" => "TEST_USER_123456@testuser.com"
        ],
        "statement_descriptor" => "ARREGLOS ALEXIA FLORES",
        "external_reference" => "PEDIDO_" . $id_pedido_nuevo,
    ]);

    unset($_SESSION['carrito']);
    $db_connection->commit();
    echo json_encode(['status' => 'success', 'init_point' => $preference->init_point]);

} catch (Exception $e) {
    if ($db_connection->inTransaction()) {
        $db_connection->rollBack();
    }
    echo json_encode(['status' => 'error', 'message' => 'Error al procesar el pedido: ' . $e->getMessage()]);
}
?>