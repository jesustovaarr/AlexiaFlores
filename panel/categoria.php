<?php
require_once("../models/categoria.php");
$app = new Categoria();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['categoria'] = $_POST['categoria'];
            $data['descripcion'] = $_POST['descripcion'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Categoría dada de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría no fue dada de alta", 'tipo' => "danger"];
            }
            header("Location: categoria.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Categoría modificada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría no fue modificada", 'tipo' => "danger"];
            }
            header("Location: categoria.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Categoría eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: categoria.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/categoria/index.php");
        break;
}
include_once("./views/footer.php");
?>