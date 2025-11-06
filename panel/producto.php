<?php
require_once("../models/producto.php");
require_once("../models/categoria.php");
require_once("../models/destacado.php");
$app = new Producto();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$categorias = new Categoria();
$destacados = new Destacado();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['producto'] = $_POST['producto'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['precio'] = $_POST['precio'];
            $data['stock_disponible'] = $_POST['stock_disponible'];
            $data['id_categoria'] = $_POST['id_categoria'];
            $data['id_destacado'] = !empty($_POST['id_destacado']) ? $_POST['id_destacado'] : null;
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Producto dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El producto no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/producto/index.php");
        } else {
            $data_categoria = $categorias->read();
            $data_destacado = $destacados->read();
            include_once("./views/producto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['producto'] = $_POST['producto'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['precio'] = $_POST['precio'];
            $data['stock_disponible'] = $_POST['stock_disponible'];
            $data['id_categoria'] = $_POST['id_categoria'];
            $data['id_destacado'] = !empty($_POST['id_destacado']) ? $_POST['id_destacado'] : null;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Producto modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El producto no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/producto/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            $data_categoria = $categorias->read();
            $data_destacado = $destacados->read();
            include_once("./views/producto/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Producto eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El producto no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/producto/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/producto/index.php");
        break;
}
include_once("./views/footer.php");
?>