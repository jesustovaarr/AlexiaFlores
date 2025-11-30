<main>
    <section class="container my-5">
        
        <h1 class="titulo-seccion">Promociones</h1>
        <p class="descripcion-seccion">
            Descubre nuestras ofertas y promociones especiales. ¡Aprovecha los descuentos en tus productos favoritos por tiempo limitado!
        </p>

        <div class="contenedor-promociones">

            <?php if (empty($promociones)): ?>
                <p>No hay promociones disponibles en este momento.</p>
            <?php else: ?>
                <?php foreach ($promociones as $promocion) :?>
                    <div class="card tarjeta-promocion">
                        <?php if (!empty($promocion['imagen_banner'])): ?>
                            <img src="<?php echo 'images/promocion/' . $promocion['imagen_banner']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($promocion['promocion']); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $promocion['promocion']; ?></h5>
                            <p class="card-text"><?php echo $promocion['descripcion']; ?></p>
                            <a href="productos.php?promocion=<?php echo $promocion['id_promocion']; ?>" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif; ?>

        </div>
    </section>
</main>
