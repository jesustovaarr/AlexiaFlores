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

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $id_usuario = $_POST['id_usuario'];
            $id_rol = $_POST['id_rol'];
            $filas = $usuarioRolApp->create($id_usuario, $id_rol);

            if ($filas) {
                $alerta['mensaje'] = "Asignación creada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La asignación no fue creada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $usuarioRolApp->read();
            include("./views/usuario_rol/index.php");
        } else {
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
                $alerta['mensaje'] = "Asignación eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La asignación no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $usuarioRolApp->read();
        include_once("./views/usuario_rol/index.php");
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_rol = $_GET['id_rol'];
            $id_rol_nuevo = $_POST['id_rol_nuevo'];
            $filas = $usuarioRolApp->update($id_usuario, $id_rol, $id_rol_nuevo);
    
            if ($filas) {
                $alerta['mensaje'] = "Asignación actualizada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La asignación no fue actualizada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $usuarioRolApp->read();
            include("./views/usuario_rol/index.php");
        } else {
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
        $data = $usuarioRolApp->read();
        $usuarios = $usuarioApp->read();
        $roles = $rolApp->read();
        include_once("./views/usuario_rol/index.php");
        break;
}

include_once("./views/footer.php");
?>