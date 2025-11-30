<main>
    <section class="container my-5">
        <h1 class="titulo-seccion">Productos</h1>
        <p class="descripcion-seccion">
            Explora nuestra exclusiva colección de arreglos florales y decoraciones. Encuentra la pieza perfecta para cada ocasión, desde eventos especiales hasta la belleza diaria de tu hogar. Cada creación está diseñada con pasión y detalle para llevar un toque de distinción a tu vida.
        </p>

        <div class="barra-filtros">
            <div>
                <i class="fa-solid fa-filter"></i>
                <a href="#" id="abrirFiltroOrdenModal">Filtrar y ordenar</a>
            </div>
            <span>Mostrando <?php echo count($productos); ?> resultados</span>
        </div>

        <div id="filtroOrdenModal" class="modal">
            <div class="modal-content">
                <span class="close-button" id="cerrarFiltroOrdenModal">&times;</span>
                <h2>Filtrar y Ordenar Productos</h2>
                <form id="filtroOrdenForm">
                    <div class="form-group">
                        <label>Ordenar por:</label><br>
                        <input type="radio" id="ordenRecientes" name="orden" value="mas_recientes" class="form-control-radio" <?php echo (isset($_GET['orden']) && $_GET['orden'] == 'mas_recientes') ? 'checked' : ''; ?>>
                        <label for="ordenRecientes">Más recientes</label><br>
                        <input type="radio" id="ordenAntiguos" name="orden" value="mas_antiguos" class="form-control-radio" <?php echo (isset($_GET['orden']) && $_GET['orden'] == 'mas_antiguos') ? 'checked' : ''; ?>>
                        <label for="ordenAntiguos">Más antiguos</label>
                    </div>
                    <div class="form-group">
                        <label for="precioMin">Precio mínimo:</label>
                        <input type="number" id="precioMin" name="precio_min" value="<?php echo isset($_GET['precio_min']) ? htmlspecialchars($_GET['precio_min']) : ''; ?>" min="0" step="any" class="form-control-text">
                    </div>
                    <div class="form-group">
                        <label for="precioMax">Precio máximo:</label>
                        <input type="number" id="precioMax" name="precio_max" value="<?php echo isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : ''; ?>" min="0" step="any" class="form-control-text">
                    </div>
                    <button type="submit" class="btn btn-primary">Aplicar</button>
                    <button type="button" class="btn btn-secondary" id="limpiarFiltros">Limpiar Filtros</button>
                </form>
            </div>
        </div>

        <div class="contenedor-productos">
            <?php foreach ($productos as $producto) : ?>
                <div class="card h-100 tarjeta-producto">
                    <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>">
                        <div class="contenedor-imagen">
                            <?php
                            if (!empty($producto['nombre_promocion'])) :
                                $fecha_fin = new DateTime($producto['promo_fecha_fin']);
                                $hoy = new DateTime();

                                if ($hoy <= $fecha_fin) {
                                    $dias_restantes = $hoy->diff($fecha_fin)->format("%a");
                            ?>
                                    <span class="badge-promo"><?php echo $producto['nombre_promocion']; ?></span>
                            <?php
                                }
                            endif;
                            ?>
                            <img class="imagen-principal" src="<?php echo 'images/producto/' . $producto['imagen_principal'] ?? ''; ?>">
                            <img class="imagen-hover" src="<?php echo 'images/producto/' . $producto['imagen_hover'] ?? ''; ?>">
                        </div>
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="producto_detalle.php?id=<?php echo $producto['id_producto']; ?>" class="text-decoration-none text-dark">
                                <?php echo $producto['producto']; ?>
                            </a>
                        </h5>

                        <?php
                        if (!empty($producto['nombre_promocion']) && isset($dias_restantes)) :
                            $precio_final = $app->calcularPrecioPromocional($producto);
                        ?>
                            <div class="precio-promocional">
                                <span class="precio-original">$<?php echo number_format($producto['precio'], 2); ?></span>
                                <span class="precio-final">$<?php echo number_format($precio_final, 2); ?></span>
                            </div>
                            <p class="dias-restantes">¡Quedan <?php echo $dias_restantes; ?> días!</p>
                        <?php else : ?>
                            <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <?php
                        endif;
                        unset($dias_restantes);
                        ?>

                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-3">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
