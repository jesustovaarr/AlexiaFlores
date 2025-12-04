<?php
require_once("../models/privilegio.php");
$app = new Privilegio();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['privilegio'] = $_POST['privilegio'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Privilegio dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El privilegio no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: privilegio.php");
            exit();
        } else {
            include_once("./views/header.php");
            include("./views/privilegio/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['privilegio'] = $_POST['privilegio'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Privilegio modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El privilegio no fue modificado", 'tipo' => "danger"];
            }
            header("Location: privilegio.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Privilegio eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El privilegio no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: privilegio.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/privilegio/index.php");
        break;
}
include_once("./views/footer.php");
?>