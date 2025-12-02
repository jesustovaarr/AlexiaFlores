<?php
require_once("../models/imagen_producto.php");
require_once("../models/producto.php");
$app = new ImagenProducto();
$app -> checarRol('Administrador');
$productoModel = new Producto();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$productos = $productoModel->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            try {
                $filas = $app->create($data);
                if ($filas) {
                    $alerta['mensaje'] = "Imagen de producto dada de alta correctamente";
                    $alerta['tipo'] = "success";
                } else {
                    $alerta['mensaje'] = "La imagen de producto no fue dada de alta (razón desconocida)";
                    $alerta['tipo'] = "danger";
                }
            } catch (Exception $e) {
                $alerta['mensaje'] = $e->getMessage();
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/imagen_producto/index.php");
        } else {
            include_once("./views/imagen_producto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            try {
                $filas = $app->update($data, $id);
                if ($filas) {
                    $alerta['mensaje'] = "Imagen de producto modificada correctamente";
                    $alerta['tipo'] = "success";
                } else {
                    $alerta['mensaje'] = "La imagen de producto no fue modificada (razón desconocida)";
                    $alerta['tipo'] = "danger";
                }
            } catch (Exception $e) {
                $alerta['mensaje'] = $e->getMessage();
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/imagen_producto/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/imagen_producto/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Imagen de producto eliminada correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La imagen de producto no fue eliminada";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/imagen_producto/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/imagen_producto/index.php");
        break;
}
include_once("./views/footer.php");
?>