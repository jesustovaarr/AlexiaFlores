<main>
    <section class="container my-5">
        
        <h1 class="titulo-seccion">Productos</h1>
        <p class="descripcion-seccion">
            Explora nuestra exclusiva colección de arreglos florales y decoraciones. Encuentra la pieza perfecta para cada ocasión, desde eventos especiales hasta la belleza diaria de tu hogar. Cada creación está diseñada con pasión y detalle para llevar un toque de distinción a tu vida.
        </p>

        <div class="barra-filtros">
            <div>
                <i class="fa-solid fa-filter"></i>
                <a href="#">Filtrar y ordenar</a>
            </div>
            <span>Mostrando <?php echo count($productos); ?> resultados</span>
        </div>

        <div class="contenedor-productos">

            <?php foreach ($productos as $producto) :?>

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
                        <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?> MXN</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-3">

                    </div>
                </div>

            <?php endforeach;?>

        </div>
    </section>
</main>