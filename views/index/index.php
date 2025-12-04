<main>
    <div id="carruselPromociones" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($promociones as $index => $promo): ?>
            <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                <a href="productos.php?promocion=<?php echo $promo['id_promocion']; ?>">
                    <img src="images/promocion/<?php echo $promo['imagen_banner']; ?>" class="d-block w-100"
                        alt="<?php echo $promo['promocion']; ?>">
                </a>
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
                    <?php include('views/producto/_tarjeta_producto.php'); ?>
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