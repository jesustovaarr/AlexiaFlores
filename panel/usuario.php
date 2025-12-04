<?php
require_once("../models/usuario.php");
$app = new Usuario();
$app -> checarRol('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['correo'] = $_POST['correo'];
            $data['contrasena'] = $_POST['contrasena'];
            $filas = $app-> create($data);
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Usuario dado de alta correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El usuario no fue dado de alta", 'tipo' => "danger"];
            }
            header("Location: usuario.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/usuario/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['correo'] = $_POST['correo'];
            $data['contrasena'] = $_POST['contrasena'];
            $id = $_GET['id'];
            $filas = $app-> update($data, $id);
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Usuario modificado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El usuario no fue modificado", 'tipo' => "danger"];
            }            
            header("Location: usuario.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app-> readOne($id);
            include_once("./views/usuario/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app-> delete($id);
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Usuario eliminado correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "El usuario no fue eliminado", 'tipo' => "danger"];
            }
            header("Location: usuario.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app-> read();
        foreach ($data as &$usuario) {
            $usuario['roles'] = $app-> getRoles($usuario['correo']);
            $usuario['permisos'] = $app-> getPermisos($usuario['correo']);
        }
        unset($usuario);

        include_once("./views/usuario/index.php");
        break;
}
include_once("./views/footer.php");
//print_r($_SESSION);
?>