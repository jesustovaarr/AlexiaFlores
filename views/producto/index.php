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

                        <h3><?php echo $producto['producto']; ?></h3>

                        <p class="precio">Desde <?php echo $producto['precio']; ?></p>
                    
                    </a>
                </article>

            <?php endforeach;?>

        </div>
    </section>
</main>