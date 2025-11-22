<?php
require_once(__DIR__ . "/models/producto.php");

$producto_modelo = new Producto();
$listado_productos = array();
$termino_busqueda = '';
$hay_termino_busqueda = false;

if (isset($_GET['q'])) {
    $termino_busqueda_crudo = $_GET['q'];
    $termino_busqueda_limpio = trim($termino_busqueda_crudo);

    if (!empty($termino_busqueda_limpio)) {
        $termino_busqueda = $termino_busqueda_limpio;
        $hay_termino_busqueda = true;        

        $productos_encontrados = $producto_modelo->buscar($termino_busqueda);

        foreach ($productos_encontrados as $producto) {
            $primera_imagen = $producto_modelo->obtenerPrimeraImagen($producto['id_producto']);
            $segunda_imagen = $producto_modelo->obtenerSegundaImagen($producto['id_producto']);
            $producto['imagen_principal'] = $primera_imagen['imagen_producto'] ?? null;
            $producto['imagen_hover'] = $segunda_imagen['imagen_producto'] ?? null;
            $listado_productos[] = $producto;
        }
    }
}
require_once(__DIR__ . '/views/buscar/index.php');
?>
