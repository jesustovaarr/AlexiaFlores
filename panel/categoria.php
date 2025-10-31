<?php
require_once("../models/categoria.php");
$app = new Categoria();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['categoria'] = $_POST['categoria'];
            $data['descripcion'] = $_POST['descripcion'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Categoría dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/categoria/index.php");
        } else {
            include_once("./views/categoria/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['categoria'] = $_POST['categoria'];
            $data['descripcion'] = $_POST['descripcion'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Categoría modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/categoria/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/categoria/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Categoría eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/categoria/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/categoria/index.php");
        break;
}
include_once("./views/footer.php");
?>