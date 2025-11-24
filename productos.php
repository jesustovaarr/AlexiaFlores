<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/producto.php");
include_once("./views/header.php");
$app = new Producto();
$productos = $app -> read();

foreach ($productos as &$producto) {
    $primera_imagen = $app->obtenerPrimeraImagen($producto['id_producto']);
    $segunda_imagen = $app->obtenerSegundaImagen($producto['id_producto']);
    
    $producto['imagen_principal'] = $primera_imagen['imagen_producto'] ?? null;
    $producto['imagen_hover'] = $segunda_imagen['imagen_producto'] ?? null;
}
unset($producto);

include_once("./views/producto/index.php");
include_once("./views/footer.php");
?>