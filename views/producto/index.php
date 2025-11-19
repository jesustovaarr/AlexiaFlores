<main>
    <section class="container my-5">
        
        <h1 class="titulo-seccion">Productos</h1>
        <p class="descripcion-seccion">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium natus dicta delectus quae cupiditate illum assumenda voluptates aut laborum fuga? Odit, facilis! Fugiat quis aliquam sapiente laboriosam itaque voluptate ut!
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

                <article class="tarjeta-producto">
                    <a href="#">
                        <div class="contenedor-imagen">

                            <img class="imagen-principal" src="<?php echo 'images/producto/' . $producto['imagen_principal'] ?>" alt="<?php echo $producto['producto']; ?>">
                            <img class="imagen-hover" src="<?php echo 'images/producto/' . $producto['imagen_hover'] ?>" alt="<?php echo $producto['producto']; ?> Hover">
                        </div>
                    </a>

                    <h3><a href="#"><?php echo $producto['producto']; ?></a></h3>

                    <p class="precio">Desde $<?php echo number_format($producto['precio'], 2); ?></p>

                    <form action="carrito.php" method="post">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                        <input type="hidden" name="producto" value="<?php echo $producto['producto']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                        <input type="hidden" name="imagen" value="<?php echo $producto['imagen_principal']; ?>">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" name="action" value="add" class="btn btn-primary">Añadir al carrito</button>
                    </form>
                </article>

            <?php endforeach;?>

        </div>
    </section>
</main>