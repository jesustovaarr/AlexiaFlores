<?php
require_once("../models/usuario_rol.php");
require_once("../models/usuario.php");
require_once("../models/rol.php");

$usuarioRolApp = new UsuarioRol();
$usuarioApp = new Usuario();
$rolApp = new Rol();

$usuarioRolApp->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $id_usuario = $_POST['id_usuario'];
            $id_rol = $_POST['id_rol'];
            $filas = $usuarioRolApp->create($id_usuario, $id_rol);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación creada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue creada", 'tipo' => "danger"];
            }
            header("Location: usuario_rol.php");
            exit();
        } else {
            include_once("./views/header.php");
            $data['usuarios'] = $usuarioApp->read();
            $data['roles'] = $rolApp->read();
            include("./views/usuario_rol/_form.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id_usuario']) && isset($_GET['id_rol'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_rol = $_GET['id_rol'];
            $filas = $usuarioRolApp->delete($id_usuario, $id_rol);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: usuario_rol.php");
            exit();
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_rol = $_GET['id_rol'];
            $id_rol_nuevo = $_POST['id_rol_nuevo'];
            $filas = $usuarioRolApp->update($id_usuario, $id_rol, $id_rol_nuevo);
    
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación actualizada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue actualizada", 'tipo' => "danger"];
            }
            header("Location: usuario_rol.php");
            exit();
        } else {
            include_once("./views/header.php");
            if (isset($_GET['id_usuario']) && isset($_GET['id_rol'])) {
                $id_usuario = $_GET['id_usuario'];
                $id_rol = $_GET['id_rol'];
                $data = $usuarioRolApp->readOne($id_usuario, $id_rol);
                $data_rol = $rolApp->read();
                include("./views/usuario_rol/_form_update.php");
            }
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $usuarioRolApp->read();
        $usuarios = $usuarioApp->read();
        $roles = $rolApp->read();
        include_once("./views/usuario_rol/index.php");
        break;
}

include_once("./views/footer.php");
?>