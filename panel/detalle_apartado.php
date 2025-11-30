<?php
require_once("../models/detalle_apartado.php");
require_once("../models/apartado.php");
require_once("../models/producto.php");

$app = new DetalleApartado();
$app->checarRol('Administrador');

$apartadoModel = new Apartado();
$productoModel = new Producto();

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $db_connection = $app->getDB();
            $db_connection->beginTransaction();
            try {
                $productoModel->setDB($db_connection);
                $productoModel->actualizarStock($data['id_producto'], -$data['cantidad']);

                $app->create($data);

                $detalles_actualizados = $app->read($data['id_apartado']);
                $nuevo_total = array_reduce($detalles_actualizados, function ($total, $detalle) {
                    return $total + ($detalle['precio_unitario'] * $detalle['cantidad']);
                }, 0);
                
                $apartadoModel->setDB($db_connection);
                $apartadoModel->updateTotal($data['id_apartado'], $nuevo_total);

                $db_connection->commit();
                $_SESSION['alerta'] = ['mensaje' => "Producto añadido al apartado correctamente.", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection->rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al añadir el producto: " . $e->getMessage(), 'tipo' => "danger"];
            }
            header('Location: detalle_apartado.php');
            exit;

        } else {
            $data['apartados'] = $apartadoModel->read();
            $data['productos'] = $productoModel->read();
            include_once("./views/detalle_apartado/_form.php");
        }
        break;

    case 'update':
        $id_detalle = $_GET['id'];
        if (isset($_POST['enviar'])) {
            $data_nueva = $_POST;
            $db_connection = $app->getDB();
            $db_connection->beginTransaction();
            try {
                $detalle_original = $app->readOne($id_detalle);
                if (!$detalle_original) throw new Exception("Detalle de apartado no encontrado.");

                $productoModel->setDB($db_connection);

                if ($detalle_original['id_producto'] == $data_nueva['id_producto']) {
                    $diferencia_cantidad = $data_nueva['cantidad'] - $detalle_original['cantidad'];
                    if ($diferencia_cantidad != 0) {
                        $productoModel->actualizarStock($data_nueva['id_producto'], -$diferencia_cantidad);
                    }
                } else {
                    $productoModel->actualizarStock($detalle_original['id_producto'], +$detalle_original['cantidad']);
                    $productoModel->actualizarStock($data_nueva['id_producto'], -$data_nueva['cantidad']);
                }

                $app->update($data_nueva, $id_detalle);

                $id_apartado_maestro = $detalle_original['id_apartado'];
                $detalles_actualizados = $app->read($id_apartado_maestro);
                $nuevo_total = array_reduce($detalles_actualizados, function ($total, $detalle) {
                    return $total + ($detalle['precio_unitario'] * $detalle['cantidad']);
                }, 0);
                
                $apartadoModel->setDB($db_connection);
                $apartadoModel->updateTotal($id_apartado_maestro, $nuevo_total);

                $db_connection->commit();
                $_SESSION['alerta'] = ['mensaje' => "Detalle de apartado actualizado correctamente.", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection->rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al actualizar el detalle: " . $e->getMessage(), 'tipo' => "danger"];
            }
            header('Location: detalle_apartado.php');
            exit;

        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            $data['apartados'] = $apartadoModel->read();
            $data['productos'] = $productoModel->read();
            include_once("./views/detalle_apartado/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id_detalle = $_GET['id'];
            $db_connection = $app->getDB();
            $db_connection->beginTransaction();
            try {
                $detalle_a_borrar = $app->readOne($id_detalle);
                if (!$detalle_a_borrar) {
                    throw new Exception("Línea de detalle no encontrada.");
                }
                $id_apartado_maestro = $detalle_a_borrar['id_apartado'];
                $id_producto_afectado = $detalle_a_borrar['id_producto'];
                $cantidad_a_restaurar = $detalle_a_borrar['cantidad'];

                $productoModel->setDB($db_connection);
                $productoModel->actualizarStock($id_producto_afectado, $cantidad_a_restaurar);

                $app->delete($id_detalle);
            
                $detalles_restantes = $app->read($id_apartado_maestro);
                $nuevo_total = array_reduce($detalles_restantes, function ($total, $detalle) {
                    return $total + ($detalle['precio_unitario'] * $detalle['cantidad']);
                }, 0);

                $apartadoModel->setDB($db_connection);
                $apartadoModel->updateTotal($id_apartado_maestro, $nuevo_total);


                $db_connection->commit();
                $_SESSION['alerta'] = ['mensaje' => "Producto eliminado del apartado y stock restaurado.", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection->rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al eliminar el producto del apartado: " . $e->getMessage(), 'tipo' => "danger"];
            }
        }
        header('Location: detalle_apartado.php');
        exit;
        break;

    default:
        $data = $app->readAll(); 
        include_once("./views/detalle_apartado/index.php");
        break;
}
include_once("./views/footer.php");
?>