<?php
require_once("../models/estado_apartado.php");
$app = new EstadoApartado();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['estado_apartado'] = $_POST['estado_apartado'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Estado del apartado dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del apartado no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/estado_apartado/index.php");
        } else {
            include_once("./views/estado_apartado/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['estado_apartado'] = $_POST['estado_apartado'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Estado del apartado modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del apartado no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/estado_apartado/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/estado_apartado/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Estado del apartado eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del apartado no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/estado_apartado/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/estado_apartado/index.php");
        break;
}
include_once("./views/footer.php");
?>