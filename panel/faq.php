<?php
require_once("../models/faq.php");
require_once("../models/categoria_faq.php");
$app = new Faq();
$app_categoria_faq = new CategoriaFaq();
// $app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_categoria_faq = $app_categoria_faq->read();
include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['pregunta'] = $_POST['pregunta'];
            $data['respuesta'] = $_POST['respuesta'];
            $data['id_categoria_faq'] = $_POST['id_categoria_faq'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Pregunta frecuente dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La pregunta frecuente no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/faq/index.php");
        } else {
            include("./views/faq/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['pregunta'] = $_POST['pregunta'];
            $data['respuesta'] = $_POST['respuesta'];
            $data['id_categoria_faq'] = $_POST['id_categoria_faq'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Pregunta frecuente modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La pregunta frecuente no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/faq/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/faq/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Pregunta frecuente eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La pregunta frecuente no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/faq/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/faq/index.php");
        break;
}
include_once("./views/footer.php");
?>