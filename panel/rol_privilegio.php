<?php
require_once("../models/rol_privilegio.php");
require_once("../models/rol.php");
require_once("../models/privilegio.php");

$rolPrivilegioApp = new RolPrivilegio();
$rolApp = new Rol();
$privilegioApp = new Privilegio();

$rolPrivilegioApp->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $id_rol = $_POST['id_rol'];
            $id_privilegio = $_POST['id_privilegio'];
            $filas = $rolPrivilegioApp->create($id_rol, $id_privilegio);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación creada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue creada", 'tipo' => "danger"];
            }
            header("Location: rol_privilegio.php");
            exit();
        } else {
            include_once("./views/header.php");
            $data['roles'] = $rolApp->read();
            $data['privilegios'] = $privilegioApp->read();
            include("./views/rol_privilegio/_form.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id_rol']) && isset($_GET['id_privilegio'])) {
            $id_rol = $_GET['id_rol'];
            $id_privilegio = $_GET['id_privilegio'];
            $filas = $rolPrivilegioApp->delete($id_rol, $id_privilegio);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: rol_privilegio.php");
            exit();
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $id_rol = $_GET['id_rol'];
            $id_privilegio = $_GET['id_privilegio'];
            $id_privilegio_nuevo = $_POST['id_privilegio_nuevo'];
            $filas = $rolPrivilegioApp->update($id_rol, $id_privilegio, $id_privilegio_nuevo);
    
            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Asignación actualizada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La asignación no fue actualizada", 'tipo' => "danger"];
            }
            header("Location: rol_privilegio.php");
            exit();
        } else {
            include_once("./views/header.php");
            if (isset($_GET['id_rol']) && isset($_GET['id_privilegio'])) {
                $id_rol = $_GET['id_rol'];
                $id_privilegio = $_GET['id_privilegio'];
                $data = $rolPrivilegioApp->readOne($id_rol, $id_privilegio);
                $data_privilegio = $privilegioApp->read();
                include("./views/rol_privilegio/_form_update.php");
            }
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $rolPrivilegioApp->read();
        $roles = $rolApp->read();
        $privilegios = $privilegioApp->read();
        include_once("./views/rol_privilegio/index.php");
        break;
}

include_once("./views/footer.php");
?>