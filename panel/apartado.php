<?php
require_once("../models/apartado.php");
require_once("../models/cliente.php");
require_once("../models/producto.php");
require_once("../models/estado_apartado.php");
$app = new Apartado();
$app -> checarRol('Administrador');
$cliente = new Cliente();
$producto = new Producto();
$estado_apartado = new EstadoApartado();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$data_cliente = $cliente->read();
$data_producto = $producto->read();
$data_estado_apartado = $estado_apartado->read();
include_once("./views/header.php");
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['id_producto'] = $_POST['id_producto'];
            $data['cantidad'] = $_POST['cantidad'];
            $data['fecha_apartado'] = $_POST['fecha_apartado'];
            $data['fecha_limite'] = $_POST['fecha_limite'];
            $data['id_estado_apartado'] = $_POST['id_estado_apartado'];
            $filas = $app->create($data);

            if ($filas) {
                $alerta['mensaje'] = "Apartado dado de alta correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El apartado no fue dado de alta";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/apartado/index.php");
        } else {
            include_once("./views/apartado/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data['id_cliente'] = $_POST['id_cliente'];
            $data['id_producto'] = $_POST['id_producto'];
            $data['cantidad'] = $_POST['cantidad'];
            $data['fecha_apartado'] = $_POST['fecha_apartado'];
            $data['fecha_limite'] = $_POST['fecha_limite'];
            $data['id_estado_apartado'] = $_POST['id_estado_apartado'];
            $id = $_GET['id'];
            $filas = $app->update($data, $id);

            if ($filas) {
                $alerta['mensaje'] = "Apartado modificado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El apartado no fue modificado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
            $data = $app->read();
            include_once("./views/apartado/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/apartado/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $alerta['mensaje'] = "Apartado eliminado correctamente";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "El apartado no fue eliminado";
                $alerta['tipo'] = "danger";
            }
            include_once("./views/alert.php");
        }
        $data = $app->read();
        include_once("./views/apartado/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/apartado/index.php");
        break;
}
include_once("./views/footer.php");
?>