<?php
require_once("../models/categoria_faq.php");
$app = new CategoriaFaq();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['categoria_faq'] = $_POST['categoria_faq'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Categoría de FAQ dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría de FAQ no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/categoria_faq/index.php");
        } else {
            include("./views/categoria_faq/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['categoria_faq'] = $_POST['categoria_faq'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Categoría de FAQ modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría de FAQ no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/categoria_faq/index.php");
        } else {
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
                $alerta['mensaje'] = "Categoría de FAQ eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La categoría de FAQ no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/categoria_faq/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/categoria_faq/index.php");
        break;
}
include_once("./views/footer.php");
?>