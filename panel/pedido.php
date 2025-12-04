<?php
require_once("../models/pedido.php");
require_once("../models/cliente.php");
require_once("../models/estado_pedido.php");
require_once("../models/metodo_pago.php");
$app = new Pedido();
$app -> checarRol('Administrador');
$cliente = new Cliente();
$estado_pedido = new EstadoPedido();
$metodo_pago = new MetodoPago();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_cliente = $cliente->read();
$data_estado_pedido = $estado_pedido->read();
$data_metodo_pago = $metodo_pago->read();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['fecha_pedido'] = $_POST['fecha_pedido'];
            $data['id_estado_pedido'] = $_POST['id_estado_pedido'];
            $data['id_metodo_pago'] = $_POST['id_metodo_pago'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Pedido dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El pedido no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: pedido.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/pedido/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['fecha_pedido'] = $_POST['fecha_pedido'];
            $data['total_pedido'] = $_POST['total_pedido'];
            $data['id_estado_pedido'] = $_POST['id_estado_pedido'];
            $data['id_metodo_pago'] = $_POST['id_metodo_pago'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Pedido modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El pedido no fue modificado", 'tipo' => "danger"];
            }
            header("Location: pedido.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/pedido/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Pedido eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El pedido no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: pedido.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/pedido/index.php");
        break;
}
include_once("./views/footer.php");
?>