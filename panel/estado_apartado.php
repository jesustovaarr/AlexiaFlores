<?php
require_once("../models/estado_apartado.php");
$app = new EstadoApartado();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['estado_apartado'] = $_POST['estado_apartado'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Estado del apartado dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del apartado no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: estado_apartado.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/estado_apartado/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['estado_apartado'] = $_POST['estado_apartado'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Estado del apartado modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del apartado no fue modificado", 'tipo' => "danger"];
            }
            header("Location: estado_apartado.php");
            exit();
        } else {
            include_once("./views/header.php");
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
                $_SESSION['alerta'] = ['mensaje' => "Estado del apartado eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El estado del apartado no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: estado_apartado.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/estado_apartado/index.php");
        break;
}
include_once("./views/footer.php");
?>