<main>
    <section class="container my-5">
        <div class="card card-body mb-4 encabezado-seccion-card">
            <h1 class="titulo-seccion">Productos</h1>
            <p class="descripcion-seccion">
                Explora nuestra exclusiva colección de arreglos florales y decoraciones. Encuentra la pieza perfecta para cada ocasión, desde eventos especiales hasta la belleza diaria de tu hogar. Cada creación está diseñada con pasión y detalle para llevar un toque de distinción a tu vida.
            </p>
        </div>
        <div class="card card-body mb-4">
            <div class="barra-filtros" style="margin-bottom: 0;">
                <div>
                    <i class="fa-solid fa-filter"></i>
                    <a href="#" id="abrirFiltroOrdenModal">Filtrar y ordenar</a>
                </div>
                <span>Mostrando <?php echo count($productos); ?> resultados</span>
            </div>
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
                        <input type="number" id="precioMin" name="precio_min" value="<?php echo isset($_GET['precio_min']) ? $_GET['precio_min'] : ''; ?>" min="0" step="any" class="form-control-text">
                    </div>
                    <div class="form-group">
                        <label for="precioMax">Precio máximo:</label>
                        <input type="number" id="precioMax" name="precio_max" value="<?php echo isset($_GET['precio_max']) ? $_GET['precio_max'] : ''; ?>" min="0" step="any" class="form-control-text">
                    </div>
                    <button type="submit" class="btn btn-primary">Aplicar</button>
                    <button type="button" class="btn btn-secondary" id="limpiarFiltros">Limpiar Filtros</button>
                </form>
            </div>
        </div>

        <div class="contenedor-productos">
            <?php foreach ($productos as $producto) : ?>
                <?php include(__DIR__ . '/_tarjeta_producto.php'); ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>
