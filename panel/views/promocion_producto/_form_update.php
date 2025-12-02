<h1 class="page-title">Editar Promoción de Producto</h1>

<div class="card">
    <div class="card-header">
        Modificar Asignación de Promoción a Producto
    </div>
    <div class="card-body">
        <form method="POST" action="promocion_producto.php?action=update&id_promocion=<?php echo $data['id_promocion']; ?>&id_producto=<?php echo $data['id_producto']; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_promocion" class="form-label">Promoción</label>
                        <select name="id_promocion" class="form-select" required>
                            <?php foreach ($data['promociones'] as $promocion): ?>
                                <option value="<?php echo $promocion['id_promocion']; ?>" <?php echo ($promocion['id_promocion'] == $data['id_promocion']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($promocion['promocion']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select name="id_producto" class="form-select" required>
                            <?php foreach ($data['productos'] as $producto): ?>
                                <option value="<?php echo $producto['id_producto']; ?>" <?php echo ($producto['id_producto'] == $data['id_producto']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($producto['producto']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valor_descuento" class="form-label">Valor de Descuento</label>
                        <input type="number" step="0.01" class="form-control" id="valor_descuento" name="valor_descuento" value="<?php echo htmlspecialchars($data['valor_descuento']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <select name="activo" class="form-select" required>
                            <option value="true" <?php echo ($data['activo']) ? 'selected' : ''; ?>>Sí</option>
                            <option value="false" <?php echo (!$data['activo']) ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo !empty($data['fecha_inicio']) ? date('Y-m-d\TH:i', strtotime($data['fecha_inicio'])) : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo !empty($data['fecha_fin']) ? date('Y-m-d\TH:i', strtotime($data['fecha_fin'])) : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="promocion_producto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

