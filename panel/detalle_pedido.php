<?php
require_once("../models/detalle_pedido.php");
require_once("../models/pedido.php");
require_once("../models/producto.php");
$app = new DetallePedido();
$app -> checarRol('Administrador');
$pedido = new Pedido();
$producto = new Producto();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_pedido = $pedido->read();
$data_producto = $producto->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['id_pedido'] = $_POST['id_pedido'];
            $data['id_producto'] = $_POST['id_producto'];
            $data['cantidad'] = $_POST['cantidad'];
            $data['precio_unitario'] = $_POST['precio_unitario'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Detalle del pedido dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El detalle del pedido no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/detalle_pedido/index.php");
        } else {
            include_once("./views/detalle_pedido/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['cantidad'] = $_POST['cantidad'];
            $data['precio_unitario'] = $_POST['precio_unitario'];
            $id_pedido = $_GET['id_pedido'];
            $id_producto = $_GET['id_producto'];
            $filas = $app->update($data, $id_pedido, $id_producto);

            if ($filas) {
                $alerta['mensaje'] = "Detalle del pedido modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El detalle del pedido no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/detalle_pedido/index.php");
        } else {
            $id_pedido = $_GET['id_pedido'];
            $id_producto = $_GET['id_producto'];
            $data = $app->readOne($id_pedido, $id_producto);
            include_once("./views/detalle_pedido/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id_pedido']) && isset($_GET['id_producto'])) {
            $id_pedido = $_GET['id_pedido'];
            $id_producto = $_GET['id_producto'];
            $filas = $app->delete($id_pedido, $id_producto);

            if ($filas) {
                $alerta['mensaje'] = "Detalle del pedido eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El detalle del pedido no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/detalle_pedido/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/detalle_pedido/index.php");
        break;
}
include_once("./views/footer.php");
?>