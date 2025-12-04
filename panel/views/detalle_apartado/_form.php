<h1 class="page-title">Nuevo Detalle de Apartado</h1>

<div class="card">
    <div class="card-header">
        Información del Detalle del Apartado
    </div>
    <div class="card-body">
        <form action="detalle_apartado.php?action=create" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_apartado" class="form-label">Apartado</label>
                        <select name="id_apartado" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Apartado</option>
                            <?php foreach ($data['apartados'] as $apartado_op): ?>
                                <option value="<?php echo $apartado_op['id_apartado']; ?>">
                                    Apartado #<?php echo $apartado_op['id_apartado'] . ' - Cliente: ' . $apartado_op['nombre_cliente'] . ' ' . $apartado_op['apellido_cliente']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select name="id_producto" class="form-select" id="id_producto" required>
                            <option value="" selected disabled>Seleccione un Producto</option>
                            <?php foreach ($data['productos'] as $producto_op): ?>
                                <option value="<?php echo $producto_op['id_producto']; ?>" data-precio="<?php echo $producto_op['precio']; ?>">
                                    <?php echo $producto_op['producto']; ?> (Stock: <?php echo $producto_op['stock_disponible']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" required min="1">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Detalle</button>
                <a href="detalle_apartado.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
