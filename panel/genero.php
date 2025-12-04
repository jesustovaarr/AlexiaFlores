<?php
require_once("../models/genero.php");
$app = new Genero();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['genero'] = $_POST['genero'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Género dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El género no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: genero.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/genero/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['genero'] = $_POST['genero'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Género modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El género no fue modificado", 'tipo' => "danger"];
            }
            header("Location: genero.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/genero/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Género eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El género no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: genero.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/genero/index.php");
        break;
}
include_once("./views/footer.php");
?>