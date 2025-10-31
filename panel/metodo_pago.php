<?php
require_once("../models/metodo_pago.php");
$app = new MetodoPago();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['metodo_pago'] = $_POST['metodo_pago'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Método de pago dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El método de pago no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/metodo_pago/index.php");
        } else {
            include_once("./views/metodo_pago/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['metodo_pago'] = $_POST['metodo_pago'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Método de pago modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El método de pago no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/metodo_pago/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/metodo_pago/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Método de pago eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El método de pago no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/metodo_pago/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/metodo_pago/index.php");
        break;
}
include_once("./views/footer.php");
?>