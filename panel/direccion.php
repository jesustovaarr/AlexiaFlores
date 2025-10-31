<?php
require_once("../models/direccion.php");
require_once("../models/cliente.php");

$app = new Direccion();
$clienteModel = new Cliente();

// $app->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$clientes = $clienteModel->read();

include_once("./views/header.php");

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['calle'] = $_POST['calle'];
            $data['numero'] = $_POST['numero'];
            $data['colonia'] = $_POST['colonia'];
            $data['ciudad'] = $_POST['ciudad'];
            $data['estado'] = $_POST['estado'];
            $data['codigo_postal'] = $_POST['codigo_postal'];
            $data['es_principal'] = isset($_POST['es_principal']) ? 1 : 0;

            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Dirección dada de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La dirección no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/direccion/index.php");
        } else {
            include("./views/direccion/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['calle'] = $_POST['calle'];
            $data['numero'] = $_POST['numero'];
            $data['colonia'] = $_POST['colonia'];
            $data['ciudad'] = $_POST['ciudad'];
            $data['estado'] = $_POST['estado'];
            $data['codigo_postal'] = $_POST['codigo_postal'];
            $data['es_principal'] = isset($_POST['es_principal']) ? 1 : 0;
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Dirección modificada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La dirección no fue modificada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
            $data = $app->read();
            include("./views/direccion/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/direccion/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Dirección eliminada correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La dirección no fue eliminada";
                $alerta['tipo'] = "danger";
            }
            include("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/direccion/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/direccion/index.php");
        break;
}

include_once("./views/footer.php");
?>