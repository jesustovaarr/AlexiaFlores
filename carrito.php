<?php
require_once("./models/producto.php");

$action = 'read';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'add':
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $fecha_entrega = isset($_POST['fecha_entrega']) ? $_POST['fecha_entrega'] : null;
        $hora_entrega = isset($_POST['hora_entrega']) ? $_POST['hora_entrega'] : null;
    
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$id_producto] = [
                'producto' => $_POST['producto'],
                'precio' => $_POST['precio'],
                'cantidad' => $cantidad,
                'imagen' => $_POST['imagen'],
                'fecha_entrega' => $fecha_entrega,
                'hora_entrega' => $hora_entrega
            ];
        }

        break;
    
    case 'update':
        header('Content-Type: application/json');
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
    
        if (isset($_SESSION['carrito'][$id_producto])) {
            if ($cantidad > 0) {
                $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;
            } else {
                unset($_SESSION['carrito'][$id_producto]);
            }
        }
        
        $subtotal = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $subtotal += $item['precio'] * $item['cantidad'];
            }
        }
        echo json_encode(['success' => true, 'subtotal' => number_format($subtotal, 2)]);
        exit;
    
    case 'remove':
        header('Content-Type: application/json');
        $id_producto = $_POST['id_producto'];
        if (isset($_SESSION['carrito'][$id_producto])) {
            unset($_SESSION['carrito'][$id_producto]);
        }

        $subtotal = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $subtotal += $item['precio'] * $item['cantidad'];
            }
        }
        echo json_encode(['success' => true, 'id_producto' => $id_producto, 'subtotal' => number_format($subtotal, 2)]);
        exit;
    
    case 'clear':
        $_SESSION['carrito'] = array();
        break;
    
    case 'read':
    default:
        break;
}

require_once(__DIR__ . '/bootstrap.php');
include_once("./views/header.php");
$app = new Producto();

include_once("./views/carrito/index.php");
include_once("./views/footer.php");
?>