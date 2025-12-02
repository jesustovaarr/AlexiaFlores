<h1 class="page-title">Editar Apartado</h1>

<div class="card">
    <div class="card-header">
        Información del Apartado
    </div>
    <div class="card-body">
        <form action="apartado.php?action=update&id=<?php echo $data['id_apartado']; ?>" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select class="form-select" id="id_cliente" name="id_cliente" required>
                            <option value="">Seleccione un cliente</option>
                            <?php foreach ($data['clientes'] as $cliente_op): ?>
                                <option value="<?php echo $cliente_op['id_cliente']; ?>" <?php echo ($data['id_cliente'] == $cliente_op['id_cliente']) ? 'selected' : ''; ?>>
                                    <?php echo $cliente_op['nombre'] . " " . $cliente_op['primer_apellido']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select class="form-select" id="id_producto" name="id_producto" required>
                            <option value="">Seleccione un producto</option>
                            <?php foreach ($data['productos'] as $producto_op): ?>
                                <option value="<?php echo $producto_op['id_producto']; ?>" <?php echo ($data['id_producto'] == $producto_op['id_producto']) ? 'selected' : ''; ?>>
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
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_apartado" class="form-label">Fecha de Apartado</label>
                        <input type="datetime-local" class="form-control" id="fecha_apartado" name="fecha_apartado" value="<?php echo !empty($data['fecha_apartado']) ? date('Y-m-d\TH:i', strtotime($data['fecha_apartado'])) : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_limite" class="form-label">Fecha Límite</label>
                        <input type="datetime-local" class="form-control" id="fecha_limite" name="fecha_limite" value="<?php echo !empty($data['fecha_limite']) ? date('Y-m-d\TH:i', strtotime($data['fecha_limite'])) : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_estado_apartado" class="form-label">Estado del Apartado</label>
                        <select class="form-select" id="id_estado_apartado" name="id_estado_apartado" required>
                            <option value="">Seleccione un estado</option>
                            <?php foreach ($data['estados'] as $estado_op): ?>
                                <option value="<?php echo $estado_op['id_estado_apartado']; ?>" <?php echo ($data['id_estado_apartado'] == $estado_op['id_estado_apartado']) ? 'selected' : ''; ?>>
                                    <?php echo $estado_op['estado_apartado']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="apartado.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

