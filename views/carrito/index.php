<div class="container my-5">
    <h2 class="titulo-seccion">Tu Carrito</h2>

    <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>

    <div id="contenedor-productos-carrito" class="row">

    
        <div class="col-lg-7">
            <?php
                $total = 0;
                foreach ($_SESSION['carrito'] as $id_producto => $item):
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
            ?>
            <div class="producto-carrito" id="row-<?php echo $id_producto; ?>">
                <a href="producto_detalle.php?id=<?php echo $id_producto; ?>" style="text-decoration: none; color: inherit;">
                    <div class="imagen-producto-carrito">
                        <img src="images/producto/<?php echo $item['imagen']; ?>" alt="<?php echo $item['producto']; ?>">
                    </div>
                </a>

                <div class="detalles-producto-carrito">
                    <div class="titulo-producto-carrito">
                        <a href="producto_detalle.php?id=<?php echo $id_producto; ?>" style="text-decoration: none; color: inherit;">
                            <?php echo $item['producto']; ?>
                        </a>
                    </div>

                    <div class="precio-producto-carrito" id="precio-<?php echo $id_producto; ?>" data-precio="<?php echo $item['precio']; ?>">
                        <?php if (isset($item['precio_original']) && $item['precio_original'] != $item['precio']): ?>
                            <span class="precio-original">$<?php echo number_format($item['precio_original'], 2); ?></span>
                            <strong class="precio-final">$<?php echo number_format($item['precio'], 2); ?></strong>
                        <?php else: ?>
                            $<?php echo number_format($item['precio'], 2); ?>
                        <?php endif; ?>
                    </div>

                    <div class="selector-cantidad">
                        <button class="btn btn-sm btn-outline-secondary quantity-down" data-id="<?php echo $id_producto; ?>">-</button>
                        <input type="text" class="form-control entrada-cantidad" value="<?php echo $item['cantidad']; ?>" min="1" data-id="<?php echo $id_producto; ?>">
                        <button class="btn btn-sm btn-outline-secondary quantity-up" data-id="<?php echo $id_producto; ?>">+</button>
                    </div>
                </div>

                <div class="subtotal-carrito" id="subtotal-<?php echo $id_producto; ?>">
                    $<?php echo number_format($subtotal, 2); ?>
                </div>

                <div class="eliminar-carrito">
                    <a href="carrito.php?action=remove&id=<?php echo $id_producto; ?>" class="link-eliminar">Eliminar</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>


        <form id="resumen-columna" class="col-lg-4 offset-lg-1" method="POST">
            <div class="resumen-compra">
                <div class="titulo-resumen-compra">
                    <span>Subtotal:</span>
                    <span id="resumen-subtotal">$<?php echo number_format($total, 2); ?></span>
                </div>

                <p class="nota-resumen-compra" id="nota-resumen"><strong>Nota:</strong> Los productos seleccionados se entregarán entre las 17:00 y las 20:00 horas del día seleccionado.</p>

                <div class="opciones-entrega">

                    <div class="opcion-entrega active" id="opcion-domicilio">
                        <i class="fas fa-truck"></i>
                        <span>Entrega a Domicilio</span>
                    </div>

                    <div class="opcion-entrega" id="opcion-apartado">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Apartar en Tienda</span>
                    </div>
                </div>

                <div id="detalles-domicilio" class="mt-3">
                    <label class="form-label">Fecha de Entrega</label>
                    <div class="input-group">
                        <button type="button" id="btn-fecha-domicilio" class="btn btn-outline-secondary date-btn">
                            <i class="fa-regular fa-calendar-days me-2"></i>Selecciona una fecha
                        </button>
                        <input type="hidden" id="fecha-domicilio" name="fecha_entrega">
                    </div>
                </div>

                <div id="detalles-apartado" class="mt-3" style="display:none;">
                    <div class="info-tienda">
                        <p><strong>Dirección:</strong> Calle Ignacio Allende #214, Rincón de Tamayo</p>
                    </div>

                    <label class="form-label">Fecha Límite de Apartado</label>
                    <div class="input-group">
                        <button type="button" id="btn-fecha-apartado" class="btn btn-outline-secondary date-btn">
                            <i class="fa-regular fa-calendar-days me-2"></i>Selecciona una fecha
                        </button>
                        <input type="hidden" id="fecha-apartado" name="fecha_limite_apartado">
                    </div>

                    <label class="form-label mt-2">Hora Límite de Apartado</label>
                    <select id="hora-apartado" name="hora_limite_apartado" class="form-select" disabled>
                        <option selected>Elige una hora</option>
                    </select>
                </div>

                <button type="submit" id="btn-accion-principal" formaction="checkout.php" class="btn btn-dark btn-proceder-pago mt-4">Proceder al Pago</button>
            </div>
        </form>

    </div>

    <div id="mensaje-carrito-vacio" style="display:none;">
        <div class="carrito-vacio">
            <div class="carrito-vacio-contenido">
                <i class="fas fa-shopping-cart"></i>
                <h3>Tu carrito está vacío</h3>
                <p>Parece que aún no has añadido productos a tu carrito.</p>
                <a class="btn btn-dark" href="productos.php">Continúa Comprando</a>
            </div>
        </div>
    </div>

    <?php else: ?>

    <div id="contenedor-productos-carrito" style="display:none;"></div>

    <div id="mensaje-carrito-vacio">
        <div class="carrito-vacio">
            <div class="carrito-vacio-contenido">
                <i class="fas fa-shopping-cart"></i>
                <h3>Tu carrito está vacío</h3>
                <p>Parece que aún no has añadido productos a tu carrito.</p>
                <a class="btn btn-dark" href="productos.php">Continúa Comprando</a>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>

<div class="modal fade" id="modal-fechas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="background-color: transparent; border: none; box-shadow: none;">
            <div class="modal-body p-0">
                <div id="contenedor-selector-fechas" class="d-flex justify-content-center">
                    <div id="selector-fechas"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="views/carrito/carrito.js"></script>