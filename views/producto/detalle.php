<?php
$imagen_principal = !empty($imagenes) ? $imagenes[0]['imagen_producto'] : 'default.jpg';
?>

<main class="container my-4">
    <div class="row align-items-center">

        <div class="col-md-6">
            <div class="contenedor-imagen-producto mb-3">
                <img id="mostrar-imagen-principal" src="images/producto/<?php echo $imagen_principal; ?>" class="imagen-principal-producto" alt="<?php echo $producto['producto']; ?>">
            </div>
        </div>

        <div class="col-md-6 product-details-panel">
            <h1 class="titulo-producto"><?php echo $producto['producto']; ?></h1>

            <?php 
            $precio_final = $producto['precio'];
            $tiene_promocion = !empty($producto['nombre_promocion']);
            if ($tiene_promocion) {
                $precio_final = $productoModel -> calcularPrecioPromocional($producto);
                $fecha_fin = new DateTime($producto['promo_fecha_fin']);
                $hoy = new DateTime();
                if ($hoy <= $fecha_fin) {
                    $dias_restantes = $hoy -> diff($fecha_fin)->format("%a");
                }
            }
            ?>

            <?php if ($tiene_promocion && isset($dias_restantes)): ?>
                <div class="precio-promocional mb-2">
                    <span class="precio-original">$<?php echo number_format($producto['precio'], 2); ?></span>
                    <span class="precio-final">$<?php echo number_format($precio_final, 2); ?> </span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <p class="dias-restantes my-0 me-3">¡Quedan <?php echo $dias_restantes; ?> días!</p>
                    <span class="badge-promo"><?php echo $producto['nombre_promocion']; ?></span>
                </div>
            <?php else: ?>
                <p class="precio-producto">$<?php echo number_format($producto['precio'], 2); ?> </p>
            <?php endif; ?>

            <hr>
            
            <div class="descripcion-producto">
                <p><?php echo nl2br($producto['descripcion']); ?></p>
            </div>

            <div class="mt-4">
                <p><strong>Disponibles:</strong> <?php echo $producto['stock_disponible']; ?></p>
            </div>

            <form action="carrito.php" method="post" class="mt-4">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                <input type="hidden" name="producto" value="<?php echo $producto['producto']; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio_final; ?>">
                <input type="hidden" name="precio_original" value="<?php echo $producto['precio']; ?>">
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

    <?php if (count($imagenes) > 1): ?>
    <div class="row mt-3">
        <div class="col-12">
            <div class="contenedor-miniaturas d-flex justify-content-start">
                <?php foreach ($imagenes as $imagen): ?>
                    <img src="images/producto/<?php echo $imagen['imagen_producto']; ?>" class="img-thumbnail me-2 miniatura-productos">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</main>

