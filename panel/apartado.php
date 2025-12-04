<?php
require_once("../models/apartado.php");
require_once("../models/cliente.php");
require_once("../models/producto.php");
require_once("../models/estado_apartado.php");

require_once("../models/detalle_apartado.php");

$app = new Apartado();
$app->checarRol('Administrador');

$clienteModel = new Cliente();
$productoModel = new Producto();
$estadoApartadoModel = new EstadoApartado();
$detalleApartadoModel = new DetalleApartado();

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $db_connection = $app -> getDB();
            $db_connection -> beginTransaction();
            try {
                $producto = $productoModel->readOne($data['id_producto']);
                if (!$producto) {
                    throw new Exception("Producto no encontrado.");
                }
                $precio_unitario = $producto['precio'];
                $cantidad = $data['cantidad'];
                $total_apartado = $precio_unitario * $cantidad;
                $data['total_apartado'] = $total_apartado;

                $productoModel -> setDB($db_connection);
                $productoModel -> actualizarStock($data['id_producto'], -$cantidad);

                $id_apartado = $app -> create($data);
                if (!$id_apartado) {
                    throw new Exception("No se pudo crear el apartado en la base de datos.");
                }

                $detalleApartadoModel->setDB($db_connection);
                $data_detalle = [
                    'id_apartado' => $id_apartado,
                    'id_producto' => $data['id_producto'],
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario
                ];
                $filas_detalle = $detalleApartadoModel->create($data_detalle);
                if (!$filas_detalle) {
                    throw new Exception("No se pudo crear el detalle del apartado.");
                }

                $db_connection -> commit();
                $_SESSION['alerta'] = ['mensaje' => "Apartado creado y stock descontado correctamente", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection -> rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al crear apartado: " . $e -> getMessage(), 'tipo' => "danger"];
            }
            include_once("./views/alert.php");
            $data = $app -> read();
            include_once("./views/apartado/index.php");
        } else {
            $data['clientes'] = $clienteModel -> read();
            $data['productos'] = $productoModel -> read();
            $data['estados'] = $estadoApartadoModel -> read();
            include_once("./views/apartado/_form.php");
        }
        break;

    case 'update':
        $id = $_GET['id'];
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $db_connection = $app->getDB();
            $db_connection->beginTransaction();
            try {
                $productoModel->setDB($db_connection);
                $detalleApartadoModel->setDB($db_connection);

                $apartado_original = $app->readOne($id);
                if (!$apartado_original) {
                    throw new Exception("Apartado original no encontrado.");
                }
                $detalles_originales = $detalleApartadoModel->read($id);
                if (empty($detalles_originales)) {
                    throw new Exception("Detalles del apartado original no encontrados.");
                }
                $detalle_original = $detalles_originales[0];
                $id_detalle_apartado = $detalle_original['id_detalle_apartado'];
                $cantidad_original = $detalle_original['cantidad'];
                $id_producto_original = $detalle_original['id_producto'];

                $cantidad_nueva = $data['cantidad'];
                $id_producto_nuevo = $data['id_producto'];

                if ($id_producto_original == $id_producto_nuevo) {
                    $diferencia_cantidad = $cantidad_nueva - $cantidad_original;
                    if ($diferencia_cantidad != 0) {
                        $productoModel->actualizarStock($id_producto_original, -$diferencia_cantidad);
                    }
                } else {
                    $productoModel->actualizarStock($id_producto_original, +$cantidad_original);
                    $productoModel->actualizarStock($id_producto_nuevo, -$cantidad_nueva);
                }

                $producto_nuevo = $productoModel->readOne($id_producto_nuevo);
                if (!$producto_nuevo) {
                    throw new Exception("El producto seleccionado para actualizar no fue encontrado.");
                }
                $data['total_apartado'] = $producto_nuevo['precio'] * $cantidad_nueva;

                $app->update($data, $id);

                $data_detalle = [
                    'id_apartado' => $id,
                    'id_producto' => $id_producto_nuevo,
                    'cantidad' => $cantidad_nueva,
                    'precio_unitario' => $producto_nuevo['precio']
                ];
                $detalleApartadoModel->update($data_detalle, $id_detalle_apartado);

                $db_connection->commit();
                $_SESSION['alerta'] = ['mensaje' => "Apartado modificado y stock ajustado correctamente", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection->rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al actualizar apartado: " . $e->getMessage(), 'tipo' => "danger"];
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/apartado/index.php");
        } else {
            $data = $app->readOne($id);
            if ($data) {
                $detalles = $detalleApartadoModel->read($id);
                if (!empty($detalles)) {
                    $data['id_producto'] = $detalles[0]['id_producto'];
                    $data['cantidad'] = $detalles[0]['cantidad'];
                }
            }
            $data['clientes'] = $clienteModel->read();
            $data['productos'] = $productoModel->read();
            $data['estados'] = $estadoApartadoModel->read();
            include_once("./views/apartado/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $db_connection = $app->getDB();
            $db_connection->beginTransaction();
            try {
                $apartado_a_borrar = $app->readOne($id);
                if (!$apartado_a_borrar) {
                    throw new Exception("Apartado no encontrado.");
                }
                
                require_once('../models/detalle_apartado.php');
                $detalleModel = new DetalleApartado();
                $detalleModel->setDB($db_connection);
                $detalles = $detalleModel->read($id);

                $filas_apartado = $app->delete($id);
                if (!$filas_apartado) {
                    throw new Exception("No se pudo eliminar el apartado.");
                }
                
                $productoModel->setDB($db_connection);
                foreach ($detalles as $detalle) {
                    $productoModel->actualizarStock($detalle['id_producto'], $detalle['cantidad']);
                }

                $db_connection->commit();
                $_SESSION['alerta'] = ['mensaje' => "Apartado eliminado y stock restaurado correctamente", 'tipo' => "success"];

            } catch (Exception $e) {
                $db_connection->rollBack();
                $_SESSION['alerta'] = ['mensaje' => "Error al eliminar apartado: " . $e->getMessage(), 'tipo' => "danger"];
            }
        }
        $data = $app->read();
        include_once("./views/apartado/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/apartado/index.php");
        break;
}
include_once("./views/footer.php");
?>