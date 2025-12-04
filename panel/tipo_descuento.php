<?php
require_once("../models/tipo_descuento.php");
$app = new TipoDescuento();
$app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['tipo_descuento'] = $_POST['tipo_descuento'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Tipo de descuento dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El tipo de descuento no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: tipo_descuento.php");
            exit();
        } else {
            include_once("./views/header.php");
            include("./views/tipo_descuento/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['tipo_descuento'] = $_POST['tipo_descuento'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Tipo de descuento modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El tipo de descuento no fue modificado", 'tipo' => "danger"];
            }
            header("Location: tipo_descuento.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/tipo_descuento/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Tipo de descuento eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El tipo de descuento no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: tipo_descuento.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/tipo_descuento/index.php");
        break;
}
include_once("./views/footer.php");
?>