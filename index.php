<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/promocion.php');
require_once(__DIR__ . '/models/producto.php');

$promocionModel = new Promocion();
$promociones = $promocionModel->read();

$app = new Producto();
$productosDestacadosRaw = $app->readDestacados();

$productosPorDestacado = [];
foreach ($productosDestacadosRaw as $producto) {
    $nombreDestacado = $producto['destacado'];
    if (!isset($productosPorDestacado[$nombreDestacado])) {
        $productosPorDestacado[$nombreDestacado] = [];
    }
    $productosPorDestacado[$nombreDestacado][] = $producto;
}

foreach ($productosPorDestacado as &$productos) {
    foreach ($productos as &$producto) {
        $primeraImagen = $app -> obtenerPrimeraImagen($producto['id_producto']);
        $producto['imagen_principal'] = $primeraImagen ? $primeraImagen['imagen_producto'] : 'default.jpg';

        $segundaImagen = $app -> obtenerSegundaImagen($producto['id_producto']);
        $producto['imagen_hover'] = $segundaImagen ? $segundaImagen['imagen_producto'] : null;
    }
    unset($producto);
}
unset($productos);

include_once('views/header.php');
include_once('views/index/index.php');
include_once('views/footer.php');
?>