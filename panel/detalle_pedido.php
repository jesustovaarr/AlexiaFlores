<?php
require_once("../models/detalle_pedido.php");
require_once("../models/pedido.php");
require_once("../models/producto.php");

$app = new DetallePedido();
$app->checarRol('Administrador');

$pedidoModel = new Pedido();
$productoModel = new Producto();

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            
            $db_connection = $app->getDB();
            $transaccion_activa = $db_connection->inTransaction();
            if (!$transaccion_activa) {
                $db_connection->beginTransaction();
            }

            try {
                $pedidoModel->setDB($db_connection);
                $productoModel->setDB($db_connection);

                $filas = $app->create($data);

                if ($filas) {
                    $pedido_original = $pedidoModel->readOne($data['id_pedido']);
                    $total_original = $pedido_original['total_pedido'];
                    
                    $nuevo_total_detalle = $data['cantidad'] * $data['precio_unitario'];
                    $total_nuevo = $total_original + $nuevo_total_detalle;
                    
                    $pedidoModel->updateTotal($data['id_pedido'], $total_nuevo);

                    $_SESSION['alerta'] = ['mensaje' => "Detalle del pedido dado de alta correctamente", 'tipo' => "success"];
                } else {
                    throw new Exception("No se pudo dar de alta el detalle del pedido.");
                }

                if (!$transaccion_activa) {
                    $db_connection->commit();
                }
            } catch (Exception $e) {
                if (!$transaccion_activa) {
                    $db_connection->rollBack();
                }
                $_SESSION['alerta'] = ['mensaje' => "Error al dar de alta el detalle del pedido: " . $e->getMessage(), 'tipo' => "danger"];
            }
            header('Location: detalle_pedido.php');
            exit;

        } else {
            $data['pedidos'] = $pedidoModel->read(); 
            $data['productos'] = $productoModel->read(); 
            include_once("./views/detalle_pedido/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data_nueva = $_POST;
            
            $db_connection = $app->getDB();
            $transaccion_activa = $db_connection->inTransaction();
            if (!$transaccion_activa) {
                $db_connection->beginTransaction();
            }

            try {
                $pedidoModel->setDB($db_connection);
                $productoModel->setDB($db_connection);

                $detalle_original = $app->readOne($data_nueva['id_pedido'], $data_nueva['id_producto']);
                if (!$detalle_original) throw new Exception("Detalle de pedido original no encontrado.");

                $diferencia_cantidad = $data_nueva['cantidad'] - $detalle_original['cantidad'];
                if ($diferencia_cantidad != 0) {
                    $productoModel->actualizarStock($data_nueva['id_producto'], -$diferencia_cantidad);
                }

                $app->update($data_nueva, $data_nueva['id_pedido'], $data_nueva['id_producto']);

                $id_pedido_maestro = $data_nueva['id_pedido'];
                $detalles_actualizados = $app->read($id_pedido_maestro);
                $nuevo_total = array_reduce($detalles_actualizados, function ($total, $detalle) {
                    return $total + ($detalle['precio_unitario'] * $detalle['cantidad']);
                }, 0);
                
                $pedidoModel->updateTotal($id_pedido_maestro, $nuevo_total);

                if (!$transaccion_activa) {
                    $db_connection->commit();
                }
                $_SESSION['alerta'] = ['mensaje' => "Detalle de pedido actualizado correctamente.", 'tipo' => "success"];

            } catch (Exception $e) {
                if (!$transaccion_activa) {
                    $db_connection->rollBack();
                }
                $_SESSION['alerta'] = ['mensaje' => "Error al actualizar el detalle: " . $e->getMessage(), 'tipo' => "danger"];
            }
            header('Location: detalle_pedido.php');
            exit;

        } else {
            $id_pedido = $_GET['id_pedido'];
            $id_producto = $_GET['id_producto'];
            $data = $app->readOne($id_pedido, $id_producto);
            $data['pedidos'] = $pedidoModel->read();
            $data['productos'] = $productoModel->read();
            include_once("./views/detalle_pedido/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id_pedido']) && isset($_GET['id_producto'])) {
            $id_pedido = $_GET['id_pedido'];
            $id_producto = $_GET['id_producto'];

            $db_connection = $app->getDB();
            $transaccion_activa = $db_connection->inTransaction();
            if (!$transaccion_activa) {
                $db_connection->beginTransaction();
            }

            try {
                $pedidoModel->setDB($db_connection);
                $productoModel->setDB($db_connection);

                $detalle_a_borrar = $app->readOne($id_pedido, $id_producto);
                if (!$detalle_a_borrar) throw new Exception("Detalle de pedido no encontrado.");

                $cantidad_a_restaurar = $detalle_a_borrar['cantidad'];
                $precio_unitario_original = $detalle_a_borrar['precio_unitario'];

                $productoModel->actualizarStock($id_producto, +$cantidad_a_restaurar);

                $app->delete($id_pedido, $id_producto);

                $detalles_restantes = $app->read($id_pedido);
                $nuevo_total = array_reduce($detalles_restantes, function ($total, $detalle) {
                    return $total + ($detalle['precio_unitario'] * $detalle['cantidad']);
                }, 0);
                
                $pedidoModel->updateTotal($id_pedido, $nuevo_total);

                if (!$transaccion_activa) {
                    $db_connection->commit();
                }
                $_SESSION['alerta'] = ['mensaje' => "Producto eliminado del pedido y stock restaurado.", 'tipo' => "success"];

            } catch (Exception $e) {
                if (!$transaccion_activa) {
                    $db_connection->rollBack();
                }
                $_SESSION['alerta'] = ['mensaje' => "Error al eliminar el producto del pedido: " . $e->getMessage(), 'tipo' => "danger"];
            }
            header('Location: detalle_pedido.php');
            exit;
        }
        break;

    case 'read':
    default:
        $data = $app->readAll();
        include_once("./views/detalle_pedido/index.php");
        break;
}
include_once("./views/footer.php");
?>