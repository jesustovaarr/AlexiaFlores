<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/producto.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_producto = $_GET['id'];
$productoModel = new Producto();
$producto = $productoModel->readOne($id_producto);

if (!$producto) {
    header("Location: index.php");
    exit();
}

$imagenes = $productoModel->obtenerImagenes($id_producto);

include_once('views/header.php');
include_once('views/producto/detalle.php'); 
echo '<script src="views/producto/detalle.js"></script>';
include_once('views/footer.php');
?>