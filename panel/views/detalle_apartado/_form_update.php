<h1 class="page-title">Editar Detalle de Apartado</h1>

<div class="card">
    <div class="card-header">
        Modificar Detalle del Apartado
    </div>
    <div class="card-body">
        <form action="detalle_apartado.php?action=update&id=<?php echo $data['id_detalle_apartado']; ?>" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_apartado" class="form-label">Apartado</label>
                        <select class="form-select" id="id_apartado" name="id_apartado" required disabled>
                            <?php foreach ($data['apartados'] as $apartado_op): ?>
                                <option value="<?php echo $apartado_op['id_apartado']; ?>" <?php echo ($data['id_apartado'] == $apartado_op['id_apartado']) ? 'selected' : ''; ?>>
                                    Apartado #<?php echo $apartado_op['id_apartado'] . ' - Cliente: ' . $apartado_op['nombre_cliente'] . ' ' . $apartado_op['apellido_cliente']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="id_apartado" value="<?php echo $data['id_apartado']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select class="form-select" id="id_producto" name="id_producto" required>
                            <option value="">Seleccione un producto</option>
                            <?php foreach ($data['productos'] as $producto_op): ?>
                                <option value="<?php echo $producto_op['id_producto']; ?>" data-precio="<?php echo $producto_op['precio']; ?>" <?php echo ($data['id_producto'] == $producto_op['id_producto']) ? 'selected' : ''; ?>>
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
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['cantidad']; ?>" required min="1">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="detalle_apartado.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
