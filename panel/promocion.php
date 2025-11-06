<?php
require_once("../models/promocion.php");
require_once("../models/tipo_descuento.php");
$app = new Promocion();
$app -> checarRol('Administrador');
$tipo_descuento = new TipoDescuento();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_tipo_descuento = $tipo_descuento->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Promoción dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/promocion/index.php");
        } else {
            include_once("./views/promocion/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Promoción modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/promocion/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/promocion/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Promoción eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La promoción no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/promocion/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/promocion/index.php");
        break;
}
include_once("./views/footer.php");
?>