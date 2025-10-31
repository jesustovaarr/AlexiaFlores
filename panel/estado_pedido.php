<?php
require_once("../models/estado_pedido.php");
$app = new EstadoPedido();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['estado_pedido'] = $_POST['estado_pedido'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Estado del pedido dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del pedido no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/estado_pedido/index.php");
        } else {
            include_once("./views/estado_pedido/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['estado_pedido'] = $_POST['estado_pedido'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Estado del pedido modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del pedido no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/estado_pedido/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/estado_pedido/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Estado del pedido eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El estado del pedido no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/estado_pedido/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/estado_pedido/index.php");
        break;
}
include_once("./views/footer.php");
?>