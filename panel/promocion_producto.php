<?php
require_once("../models/promocion_producto.php");
require_once("../models/promocion.php");
require_once("../models/producto.php");

$app = new PromocionProducto();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$productos = new Producto();
$promociones = new Promocion();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['id_promocion'] = $_POST['id_promocion'];
            $data['id_producto'] = $_POST['id_producto'];
            $data['valor_descuento'] = $_POST['valor_descuento'];
            $data['fecha_inicio'] = $_POST['fecha_inicio'];
            $data['fecha_fin'] = $_POST['fecha_fin'];
            $data['activo'] = $_POST['activo'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Promoción de producto dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción de producto no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/promocion_producto/index.php");
        } else {
            $data['productos'] = $productos->read();
            $data['promociones'] = $promociones->read();
            include_once("./views/promocion_producto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['id_promocion'] = $_POST['id_promocion'];
            $data['id_producto'] = $_POST['id_producto'];
            $data['valor_descuento'] = $_POST['valor_descuento'];
            $data['fecha_inicio'] = $_POST['fecha_inicio'];
            $data['fecha_fin'] = $_POST['fecha_fin'];
            $data['activo'] = $_POST['activo'];
            $id_promocion = $_GET['id_promocion'];
            $id_producto = $_GET['id_producto'];
            $filas = $app->update($data, $id_promocion, $id_producto);

            if ($filas) {
                $alerta['mensaje'] = "Promoción de producto modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción de producto no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/promocion_producto/index.php");
        } else {
            $id_promocion = $_GET['id_promocion'];
            $id_producto = $_GET['id_producto'];
            $data = $app->readOne($id_promocion, $id_producto);
            $data['productos'] = $productos->read();
            $data['promociones'] = $promociones->read();
            include_once("./views/promocion_producto/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id_promocion']) && isset($_GET['id_producto'])) {
            $id_promocion = $_GET['id_promocion'];
            $id_producto = $_GET['id_producto'];
            $filas = $app->delete($id_promocion, $id_producto);

            if ($filas) {
                $alerta['mensaje'] = "Promoción de producto eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción de producto no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/promocion_producto/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/promocion_producto/index.php");
        break;
}
include_once("./views/footer.php");
?>