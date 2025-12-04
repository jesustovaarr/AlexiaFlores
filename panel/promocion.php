<?php
require_once("../models/promocion.php");
require_once("../models/tipo_descuento.php");
$app = new Promocion();
$app -> checarRol('Administrador');
$tipo_descuento = new TipoDescuento();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_tipo_descuento = $tipo_descuento->read();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Promoción dada de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La promoción no fue dada de alta", 'tipo' => "danger"];
            }
            header("Location: promocion.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/promocion/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Promoción modificada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La promoción no fue modificada", 'tipo' => "danger"];
            }
            header("Location: promocion.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Promoción eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La promoción no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: promocion.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/promocion/index.php");
        break;
}
include_once("./views/footer.php");
?>