<?php
require_once("../models/rol.php");
$app = new Rol();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['rol'] = $_POST['rol'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Rol dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El rol no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: rol.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/rol/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['rol'] = $_POST['rol'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Rol modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El rol no fue modificado", 'tipo' => "danger"];
            }
            header("Location: rol.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/rol/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Rol eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El rol no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: rol.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/rol/index.php");
        break;
}
include_once("./views/footer.php");
?>