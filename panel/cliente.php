<?php
require_once("../models/cliente.php");
require_once("../models/usuario.php");
require_once("../models/genero.php");
$_GET['include_base64'] = 'true';
$app = new Cliente();
$app -> checarRol('Administrador');
$usuarioModel = new Usuario();
$generoModel = new Genero();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$usuarios = $usuarioModel->read();
$generos = $generoModel->read();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Cliente dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El cliente no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: cliente.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/cliente/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Cliente modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El cliente no fue modificado", 'tipo' => "danger"];
            }
            header("Location: cliente.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/cliente/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Cliente eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El cliente no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: cliente.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/cliente/index.php");
        break;
}
include_once("./views/footer.php");
?>