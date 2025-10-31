<?php
require_once("../models/cliente.php");
require_once("../models/usuario.php");
require_once("../models/genero.php");
$app = new Cliente();
$app -> checarRol('Administrador');
$usuarioModel = new Usuario();
$generoModel = new Genero();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$usuarios = $usuarioModel->read();
$generos = $generoModel->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);
            if ($filas) {
                $alerta['mensaje'] = "Cliente dado de alta correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El cliente no fue dado de alta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/cliente/index.php");
        } else {
            include_once("./views/cliente/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Cliente modificado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El cliente no fue modificado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/cliente/index.php");
        } else {
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
                $alerta['mensaje'] = "Cliente eliminado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El cliente no fue eliminado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/cliente/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/cliente/index.php");
        break;
}
include_once("./views/footer.php");
?>