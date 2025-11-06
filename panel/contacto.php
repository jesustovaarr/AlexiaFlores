<?php
require_once("../models/contacto.php");
require_once("../models/cliente.php");
$app = new Contacto();
$app->checarRol('Administrador');
$clienteModel = new Cliente();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$clientes = $clienteModel->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);
            if ($filas) {
                $alerta['mensaje'] = "Mensaje de contacto guardado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El mensaje de contacto no fue guardado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/contacto/index.php");
        } else {
            include_once("./views/contacto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Mensaje de contacto modificado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El mensaje de contacto no fue modificado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/contacto/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/contacto/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Mensaje de contacto eliminado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "El mensaje de contacto no fue eliminado";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/contacto/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/contacto/index.php");
        break;
}
include_once("./views/footer.php");
?>