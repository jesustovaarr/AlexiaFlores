<?php
require_once("../models/privilegio.php");
$app = new Privilegio();
// $app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['privilegio'] = $_POST['privilegio'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Privilegio dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El privilegio no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/privilegio/index.php");
        } else {
            include("./views/privilegio/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['privilegio'] = $_POST['privilegio'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Privilegio modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El privilegio no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/privilegio/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/privilegio/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Privilegio eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El privilegio no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/privilegio/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/privilegio/index.php");
        break;
}
include_once("./views/footer.php");
?>