<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/pedido.php');
require_once(__DIR__ . '/models/direccion.php');
require_once(__DIR__ . '/models/apartado.php');

if (!$sesion_iniciada || $es_admin) {
    header("Location: panel/login.php");
    exit();
}

$clienteModel = new Cliente();
$pedidoModel = new Pedido();
$direccionModel = new Direccion();
$apartadoModel = new Apartado();

$data = [];
$cliente = $clienteModel -> getClientePorCorreo($_SESSION['correo']);
$id_cliente = $cliente['id_cliente'];

$action = isset($_GET['action']) ? $_GET['action'] : 'perfil';
$do = isset($_GET['do']) ? $_GET['do'] : 'read';

switch ($action) {
    case 'pedidos':
        require_once(__DIR__ . '/models/detalle_pedido.php');
        $detallePedidoModel = new DetallePedido();
        $pedidos = $pedidoModel->readFromCliente($id_cliente);
        
        foreach ($pedidos as $key => $pedido) {
            $pedidos[$key]['detalles'] = $detallePedidoModel->read($pedido['id_pedido']);
        }
        $data = $pedidos;
        break;
    
    case 'apartados':
        require_once(__DIR__ . '/models/detalle_apartado.php');
        $detalleApartadoModel = new DetalleApartado();
        
        $apartados = $apartadoModel->readFromCliente($id_cliente);
        
        foreach ($apartados as $key => $apartado) {
            $apartados[$key]['detalles'] = $detalleApartadoModel->read($apartado['id_apartado']);
        }
        $data = $apartados;
        break;

    case 'direcciones':
        switch ($do) {
            case 'create':
                if (isset($_POST['enviar'])) {
                    $new_direccion = $_POST;
                    $new_direccion['id_cliente'] = $id_cliente;
                    $new_direccion['es_principal'] = isset($_POST['es_principal']) ? 1 : 0;
                    try {
                        $direccionModel->create($new_direccion);
                        $_SESSION['alerta'] = ['tipo' => 'success', 'mensaje' => 'Dirección creada correctamente.'];
                    } catch (Exception $e) {
                        $_SESSION['alerta'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear la dirección: ' . $e->getMessage()];
                    }
                    header('Location: cliente.php?action=direcciones');
                    exit;
                }
                break;
            case 'update':
                $id_direccion = $_GET['id'];
                if (isset($_POST['enviar'])) {
                    $update_direccion = $_POST;
                    $update_direccion['id_cliente'] = $id_cliente;
                    $update_direccion['es_principal'] = isset($_POST['es_principal']) ? 1 : 0;
                    try {
                        $direccionModel->update($update_direccion, $id_direccion);
                         $_SESSION['alerta'] = ['tipo' => 'success', 'mensaje' => 'Dirección actualizada correctamente.'];
                    } catch (Exception $e) {
                         $_SESSION['alerta'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar la dirección: ' . $e->getMessage()];
                    }
                    header('Location: cliente.php?action=direcciones');
                    exit;
                }
                $data = $direccionModel->readOne($id_direccion);
                break;
            case 'delete':
                $id_direccion = $_GET['id'];
                try {
                    $direccionModel->delete($id_direccion);
                    $_SESSION['alerta'] = ['tipo' => 'success', 'mensaje' => 'Dirección eliminada correctamente.'];
                } catch (Exception $e) {
                    $_SESSION['alerta'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar la dirección: ' . $e->getMessage()];
                }
                header('Location: cliente.php?action=direcciones');
                exit;
            case 'principal':
                $id_direccion = $_GET['id'];
                try {
                    $direccionModel->setPrincipal($id_direccion, $id_cliente);
                    $_SESSION['alerta'] = ['tipo' => 'success', 'mensaje' => 'Dirección principal actualizada.'];
                } catch (Exception $e) {
                    $_SESSION['alerta'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar la dirección principal: ' . $e->getMessage()];
                }
                header('Location: cliente.php?action=direcciones');
                exit;
            case 'read':
            default:
                $data = $direccionModel->readFromCliente($id_cliente);
                break;
        }
        break;

    case 'perfil':
        switch ($do) {
            case 'update':
                if (isset($_POST['nombre'])) {
                    $resultado = $clienteModel->actualizarPerfil($id_cliente, $cliente['id_usuario'], $_POST);
                    if ($resultado) {
                        if (!isset($_SESSION['alerta'])) {
                            $_SESSION['alerta'] = ['mensaje' => 'Tu perfil ha sido actualizado correctamente.', 'tipo' => 'success'];
                        }
                    } else {
                        if (!isset($_SESSION['alerta'])) {
                            $_SESSION['alerta'] = ['mensaje' => 'Ocurrió un error al actualizar tu perfil.', 'tipo' => 'danger'];
                        }
                    }
                }
                header("Location: cliente.php?action=perfil");
                exit();
            case 'edit':
                $datos_cliente = $cliente;
                break;
            case 'read':
            default:
                break;
        }
        break;
}

require_once(__DIR__ . '/views/header.php');
require_once(__DIR__ . '/views/cliente/index.php');
require_once(__DIR__ . '/views/footer.php');
?>