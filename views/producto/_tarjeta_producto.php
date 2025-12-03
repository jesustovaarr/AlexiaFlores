<div class="card h-100 tarjeta-producto">
    <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>">
        <div class="contenedor-imagen">
            <?php
            if (!empty($producto['nombre_promocion'])) {
                $fecha_fin = new DateTime($producto['promo_fecha_fin']);
                $hoy = new DateTime();
                if ($hoy <= $fecha_fin) {
                    $dias_restantes = $hoy->diff($fecha_fin)->format("%a");
                    echo '<span class="badge-promo">' . $producto['nombre_promocion'] . '</span>';
                }
            }
            ?>
            <img class="imagen-principal" src="<?php echo 'images/producto/' . ($producto['imagen_principal'] ?? 'default.jpg'); ?>" alt="<?php echo $producto['producto']; ?>">
            <?php if (!empty($producto['imagen_hover'])): ?>
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

        <?php
        if (!empty($producto['nombre_promocion']) && isset($dias_restantes)) {
            $precio_final = $app -> calcularPrecioPromocional($producto);
            ?>
            <div class="precio-promocional">
                <span class="precio-original">$<?php echo number_format($producto['precio'], 2); ?></span>
                <span class="precio-final">$<?php echo number_format($precio_final, 2); ?></span>
            </div>
            <p class="dias-restantes">¡Quedan <?php echo $dias_restantes; ?> días!</p>
            <?php
        } else {
            ?>
            <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?></p>
            <?php
        }
        unset($dias_restantes);
        ?>
    </div>
    <div class="card-footer bg-transparent border-0 text-center pb-3">
    </div>
</div>
