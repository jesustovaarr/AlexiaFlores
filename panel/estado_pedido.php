<?php
require_once("../models/estado_pedido.php");
$app = new EstadoPedido();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['estado_pedido'] = $_POST['estado_pedido'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Estado del pedido dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del pedido no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: estado_pedido.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/estado_pedido/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['estado_pedido'] = $_POST['estado_pedido'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Estado del pedido modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del pedido no fue modificado", 'tipo' => "danger"];
            }
            header("Location: estado_pedido.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Estado del pedido eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del pedido no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: estado_pedido.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/estado_pedido/index.php");
        break;
}
include_once("./views/footer.php");
?>