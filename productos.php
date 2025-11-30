<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/producto.php");

$app = new Producto();
$opciones_filtro_orden = [];

if (isset($_GET['precio_min']) && is_numeric($_GET['precio_min'])) {
    $opciones_filtro_orden['precio_min'] = $_GET['precio_min'];
}

if (isset($_GET['precio_max']) && is_numeric($_GET['precio_max'])) {
    $opciones_filtro_orden['precio_max'] = $_GET['precio_max'];
}

if (isset($_GET['orden'])) {
    $orden_valido = ['mas_recientes', 'mas_antiguos'];
    if (in_array($_GET['orden'], $orden_valido)) {
        $opciones_filtro_orden['orden'] = $_GET['orden'];
    }
} else {
    $opciones_filtro_orden['orden'] = 'mas_recientes';
}

if (isset($_GET['promocion']) && is_numeric($_GET['promocion'])) {
    $opciones_filtro_orden['id_promocion'] = $_GET['promocion'];
}

$productos = $app->read($opciones_filtro_orden);

foreach ($productos as &$producto) {
    $primera_imagen = $app->obtenerPrimeraImagen($producto['id_producto']);
    $segunda_imagen = $app->obtenerSegundaImagen($producto['id_producto']);
    
    $producto['imagen_principal'] = $primera_imagen['imagen_producto'] ?? null;
    $producto['imagen_hover'] = $segunda_imagen['imagen_producto'] ?? null;
}
unset($producto);


if (isset($_GET['filtro'])) {
    ob_start();
    if (empty($productos)) {
        echo '<div class="col-12"><p class="text-center">No se encontraron productos con los filtros seleccionados.</p></div>';
    } else {
        foreach ($productos as $producto) {
            ?>
            <div class="card h-100 tarjeta-producto">
                <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>">
                    <div class="contenedor-imagen">
                        <img class="imagen-principal" src="<?php echo 'images/producto/' . $producto['imagen_principal'] ?>" alt="<?php echo $producto['producto']; ?>">
                        <img class="imagen-hover" src="<?php echo 'images/producto/' . $producto['imagen_hover'] ?>" alt="<?php echo $producto['producto']; ?> Hover">
                    </div>
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>" class="text-decoration-none text-dark">
                            <?php echo $producto['producto']; ?>
                        </a>
                    </h5>
                    <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?> </p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center pb-3">

                </div>
            </div>
            <?php
        }
    }
    $html = ob_get_clean();
    
    header('Content-Type: application/json');
    echo json_encode(['html' => $html, 'count' => count($productos)]);
    exit;
}

include_once("./views/header.php");
include_once("./views/producto/index.php");
include_once("./views/footer.php");
?>