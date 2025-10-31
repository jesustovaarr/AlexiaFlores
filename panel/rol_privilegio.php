<?php
require_once("../models/rol_privilegio.php");
require_once("../models/rol.php");
require_once("../models/privilegio.php");

$rolPrivilegioApp = new RolPrivilegio();
$rolApp = new Rol();
$privilegioApp = new Privilegio();

// $rolPrivilegioApp->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $id_rol = $_POST['id_rol'];
            $id_privilegio = $_POST['id_privilegio'];
            $filas = $rolPrivilegioApp->create($id_rol, $id_privilegio);

            if ($filas) {
                $alerta['mensaje'] = "Asignación creada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La asignación no fue creada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $rolPrivilegioApp->read();
            include("./views/rol_privilegio/index.php");
        } else {
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
                $alerta['mensaje'] = "Asignación eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La asignación no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $rolPrivilegioApp->read();
        include_once("./views/rol_privilegio/index.php");
        break;

    case 'read':
    default:
        $data = $rolPrivilegioApp->read();
        $roles = $rolApp->read();
        $privilegios = $privilegioApp->read();
        include_once("./views/rol_privilegio/index.php");
        break;
}

include_once("./views/footer.php");
?>