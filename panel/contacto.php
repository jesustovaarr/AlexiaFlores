<?php
require_once("../models/contacto.php");
require_once("../models/cliente.php");
$app = new Contacto();
$app->checarRol('Administrador');
$clienteModel = new Cliente();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$clientes = $clienteModel->read();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Mensaje de contacto guardado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El mensaje de contacto no fue guardado", 'tipo' => "danger"];
            }
            header("Location: contacto.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/contacto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Mensaje de contacto modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El mensaje de contacto no fue modificado", 'tipo' => "danger"];
            }
            header("Location: contacto.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Mensaje de contacto eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El mensaje de contacto no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: contacto.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/contacto/index.php");
        break;
}
include_once("./views/footer.php");
?>