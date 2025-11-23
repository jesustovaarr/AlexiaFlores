<?php
$imagen_principal = !empty($imagenes) ? $imagenes[0]['imagen_producto'] : 'default.jpg';
?>

<main class="container my-4">
    <div class="row">

        <div class="col-md-6">
            <div class="mb-3 contenedor-imagen-principal">
                <img id="mostrar-imagen-principal" src="images/producto/<?php echo $imagen_principal; ?>" class="img-fluid rounded" alt="<?php echo $producto['producto']; ?>">
            </div>

            <?php if (count($imagenes) > 1): ?>
                <div class="contenedor-miniaturas d-flex justify-content-start">
                    <?php foreach ($imagenes as $imagen): ?>
                        <img src="images/producto/<?php echo $imagen['imagen_producto']; ?>" class="img-thumbnail me-2" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 product-details-panel">
            <h1 class="titulo-producto"><?php echo $producto['producto']; ?></h1>
            <p class="precio-producto">$<?php echo number_format($producto['precio'], 2); ?> MXN</p>
            <hr>
            
            <div class="descripcion-producto">
                <p><?php echo $producto['descripcion']; ?></p>
            </div>

            <div class="mt-4">
                <p><strong>Disponibles:</strong> <?php echo $producto['stock_disponible']; ?></p>
            </div>

            <form action="carrito.php" method="post" class="mt-4">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                <input type="hidden" name="producto" value="<?php echo $producto['producto']; ?>">
                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                <input type="hidden" name="imagen" value="<?php echo $imagen_principal; ?>">

                <div class="d-flex align-items-center mt-3">
                    <div class="selector-cantidad me-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary menos-cantidad">-</button>
                        <input type="text" name="cantidad" class="form-control text-center entrada-cantidad" value="1" min="1" data-stock="<?php echo $producto['stock_disponible']; ?>" style="width: 60px;">
                        <button type="button" class="btn btn-sm btn-outline-secondary mas-cantidad">+</button>
                    </div>
                        
                    <div>
                        <button type="submit" name="action" value="add" class="btn btn-add-al-carrito">Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

