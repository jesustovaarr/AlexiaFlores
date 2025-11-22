<?php
include_once(__DIR__ . '/../header.php');
?>
<main>
    <section class="container <?php echo !empty($listado_productos) ? 'my-5' : 'seccion-sin-resultados'; ?>">
        
        <?php if (!empty($listado_productos)): ?>
            
            <h1 class="titulo-seccion">Resultados de Búsqueda</h1>
            <p class="descripcion-seccion">
                Mostrando resultados para: <strong>"<?php echo $termino_busqueda; ?>"</strong>
            </p>
            <div class="barra-filtros">
                <span><?php echo count($listado_productos); ?> resultados encontrados</span>
            </div>

            <div class="contenedor-productos">
                <?php foreach ($listado_productos as $producto) :?>

                    <div class="card h-100 tarjeta-producto">
                        <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>">
                            <div class="contenedor-imagen">
                                <img class="imagen-principal" src="<?php echo 'images/producto/' . ($producto['imagen_principal'] ?? 'default.jpg'); ?>" alt="<?php echo $producto['producto']; ?>">
                                <?php if (isset($producto['imagen_hover'])): ?>
                                    <img class="imagen-hover" src="<?php echo 'images/producto/' . $producto['imagen_hover']; ?>" alt="<?php echo $producto['producto']; ?> Hover">
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>" class="text-decoration-none text-dark">
                                    <?php echo $producto['producto']; ?>
                                </a>
                            </h5>
                            <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?> MXN</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center pb-3">
                            <form action="carrito.php" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                <input type="hidden" name="producto" value="<?php echo $producto['producto']; ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                <input type="hidden" name="imagen" value="<?php echo $producto['imagen_principal']; ?>">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" name="action" value="add" class="btn btn-producto">Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>

        <?php else: ?>
            
            <?php if ($hay_termino_busqueda): ?>
                <div class="carrito-vacio-contenido mx-auto">
                    <i class="fa-solid fa-magnifying-glass-minus" style="font-size: 5rem; color: #d0d0d0; margin-bottom: 1.5rem;"></i>
                    <h3>Sin Resultados</h3>
                    <p class="my-3">No pudimos encontrar ningún producto que coincida con "<strong><?php echo $termino_busqueda; ?></strong>".</p>
                    <p>Intenta con un término de búsqueda diferente o explora nuestras categorías.</p>
                    <a href="productos.php" class="btn btn-producto mt-3">Ver todos los productos</a>
                </div>
            <?php else: ?>
                <div class="carrito-vacio-contenido mx-auto">
                    <i class="fa-solid fa-keyboard" style="font-size: 5rem; color: #d0d0d0; margin-bottom: 1.5rem;"></i>
                    <h3>Realiza una Búsqueda</h3>
                    <p class="my-3">Utiliza la barra de búsqueda en la parte superior para encontrar los productos que deseas.</p>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </section>
</main>

<?php
include_once(__DIR__ . '/../footer.php');
?>
