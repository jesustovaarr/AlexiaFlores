<?php
require_once("../models/categoria_faq.php");
$app = new CategoriaFaq();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['categoria_faq'] = $_POST['categoria_faq'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Categoría de FAQ dada de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría de FAQ no fue dada de alta", 'tipo' => "danger"];
            }
            header("Location: categoria_faq.php");
            exit();
        } else {
            include_once("./views/header.php");
            include("./views/categoria_faq/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['categoria_faq'] = $_POST['categoria_faq'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Categoría de FAQ modificada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría de FAQ no fue modificada", 'tipo' => "danger"];
            }
            header("Location: categoria_faq.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/categoria_faq/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Categoría de FAQ eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La categoría de FAQ no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: categoria_faq.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/categoria_faq/index.php");
        break;
}
include_once("./views/footer.php");
?>