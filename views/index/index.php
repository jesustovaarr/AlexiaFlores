<main>
    <div id="carruselPromociones" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($promociones as $index => $promo): ?>
            <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                <img src="images/promocion/<?php echo $promo['imagen_banner']; ?>" class="d-block w-100"
                    alt="<?php echo $promo['promocion']; ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselPromociones" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselPromociones" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <div class="container mt-5">
        <?php if (!empty($productosPorDestacado)): ?>
        <?php foreach ($productosPorDestacado as $nombreDestacado => $productos): ?>
        <div class="seccion-destacada mb-5">
            <h2 class="titulo-seccion-destacada text-center mb-4"><?php echo $nombreDestacado; ?></h2>
            <div class="contenedor-productos">
                <?php foreach ($productos as $producto): ?>
                <div class="card h-100 tarjeta-producto">
                    <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>">
                        <div class="contenedor-imagen">
                            <?php
                                $primeraImagen = $productoModel->obtenerPrimeraImagen($producto['id_producto']);
                                $rutaPrimeraImagen = 'images/producto/' . ($primeraImagen ? $primeraImagen['imagen_producto'] : 'default.jpg');

                                $segundaImagen = $productoModel->obtenerSegundaImagen($producto['id_producto']);
                            ?>
                            <img class="imagen-principal" src="<?php echo $rutaPrimeraImagen; ?>" alt="<?php echo $producto['producto']; ?>">
                            <?php if ($segundaImagen):
                                $rutaSegundaImagen = 'images/producto/' . $segundaImagen['imagen_producto'];
                            ?>
                                <img class="imagen-hover" src="<?php echo $rutaSegundaImagen; ?>" alt="<?php echo $producto['producto']; ?> Hover">
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
                        
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="col-12">
            <p class="text-center">No hay productos destacados por el momento.</p>
        </div>
        <?php endif; ?>
    </div>
</main>