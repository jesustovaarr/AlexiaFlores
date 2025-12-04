<?php
require_once("../models/imagen_producto.php");
require_once("../models/producto.php");
$app = new ImagenProducto();
$app -> checarRol('Administrador');
$productoModel = new Producto();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
$productos = $productoModel->read();
switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            try {
                $filas = $app->create($data);
                if ($filas) {
                    $_SESSION['alerta'] = ['mensaje' => "Imagen de producto dada de alta correctamente", 'tipo' => "success"];
                } else {
                    $_SESSION['alerta'] = ['mensaje' => "La imagen de producto no fue dada de alta (razón desconocida)", 'tipo' => "danger"];
                }
            } catch (Exception $e) {
                $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => "danger"];
            }
            header("Location: imagen_producto.php");
            exit();
        } else {
            include_once("./views/header.php");
            include_once("./views/imagen_producto/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $id = $_GET['id'];
            try {
                $filas = $app->update($data, $id);
                if ($filas) {
                    $_SESSION['alerta'] = ['mensaje' => "Imagen de producto modificada correctamente", 'tipo' => "success"];
                } else {
                    $_SESSION['alerta'] = ['mensaje' => "La imagen de producto no fue modificada (razón desconocida)", 'tipo' => "danger"];
                }
            } catch (Exception $e) {
                $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => "danger"];
            }
            header("Location: imagen_producto.php");
            exit();
        } else {
            include_once("./views/header.php");
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/imagen_producto/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);

            if ($filas) {
                $_SESSION['alerta'] = ['mensaje' => "Imagen de producto eliminada correctamente", 'tipo' => "success"];
            } else {
                $_SESSION['alerta'] = ['mensaje' => "La imagen de producto no fue eliminada", 'tipo' => "danger"];
            }
            header("Location: imagen_producto.php");
            exit();
        }
        break;

    case 'read':
    default:
        include_once("./views/header.php");
        $data = $app->read();
        include_once("./views/imagen_producto/index.php");
        break;
}
include_once("./views/footer.php");
?>