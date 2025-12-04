<?php
require_once("../models/direccion.php");
require_once("../models/cliente.php");

$app = new Direccion();
$clienteModel = new Cliente();

$app->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$clientes = $clienteModel->read();

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

            try {
                $filas = $app->create($data);
                $_SESSION['alerta'] = ['mensaje' => "Dirección dada de alta correctamente", 'tipo' => "success"];
            } catch (Exception $e) {
                $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => "danger"];
            }
            header("Location: direccion.php");
            exit();
        } else {
            include_once("./views/header.php");
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
            try {
                $filas = $app->update($data, $id);
                $_SESSION['alerta'] = ['mensaje' => "Dirección modificada correctamente", 'tipo' => "success"];
            } catch (Exception $e) {
                $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => "danger"];
            }
            header("Location: direccion.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include("./views/direccion/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            try {
                $filas = $app->delete($id);
                $_SESSION['alerta'] = ['mensaje' => "Dirección eliminada correctamente", 'tipo' => "success"];
            } catch (Exception $e) {
                $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => "danger"];
            }
            header("Location: direccion.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/direccion/index.php");
        break;
}

include_once("./views/footer.php");
?>