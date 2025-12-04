<?php
require_once("../models/destacado.php");
$app = new Destacado();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['destacado'] = $_POST['destacado'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['fecha_inicio'] = $_POST['fecha_inicio'];
            $data['fecha_fin'] = $_POST['fecha_fin'];
            $filas = $app->create($data);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Destacado dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El destacado no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: destacado.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/destacado/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['destacado'] = $_POST['destacado'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['fecha_inicio'] = $_POST['fecha_inicio'];
            $data['fecha_fin'] = $_POST['fecha_fin'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Destacado modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El destacado no fue modificado", 'tipo' => "danger"];
            }
            header("Location: destacado.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/destacado/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Destacado eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El destacado no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: destacado.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/destacado/index.php");
        break;
}
include_once("./views/footer.php");
?>