<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/promocion.php');
require_once(__DIR__ . '/models/producto.php');

$promocionModel = new Promocion();
$promociones = $promocionModel->read();

$productoModel = new Producto();
$productosDestacadosRaw = $productoModel->readDestacados();

$productosPorDestacado = [];
foreach ($productosDestacadosRaw as $producto) {
    $nombreDestacado = $producto['destacado'];
    if (!isset($productosPorDestacado[$nombreDestacado])) {
        $productosPorDestacado[$nombreDestacado] = [];
    }
    $productosPorDestacado[$nombreDestacado][] = $producto;
}

include_once('views/header.php');
include_once('views/index/index.php');
include_once('views/footer.php');
?>