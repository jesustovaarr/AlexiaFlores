<?php
require_once("../models/tipo_descuento.php");
$app = new TipoDescuento();
// $app->checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['tipo_descuento'] = $_POST['tipo_descuento'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Tipo de descuento dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El tipo de descuento no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/tipo_descuento/index.php");
        } else {
            include("./views/tipo_descuento/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['tipo_descuento'] = $_POST['tipo_descuento'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Tipo de descuento modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El tipo de descuento no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/tipo_descuento/index.php");
        } else {
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
                $alerta['mensaje'] = "Tipo de descuento eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El tipo de descuento no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/tipo_descuento/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/tipo_descuento/index.php");
        break;
}
include_once("./views/footer.php");
?>