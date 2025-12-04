<?php
require_once("../models/metodo_pago.php");
$app = new MetodoPago();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['metodo_pago'] = $_POST['metodo_pago'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Método de pago dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El método de pago no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: metodo_pago.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/metodo_pago/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['metodo_pago'] = $_POST['metodo_pago'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Método de pago modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El método de pago no fue modificado", 'tipo' => "danger"];
            }
            header("Location: metodo_pago.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Método de pago eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El método de pago no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: metodo_pago.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/metodo_pago/index.php");
        break;
}
include_once("./views/footer.php");
?>