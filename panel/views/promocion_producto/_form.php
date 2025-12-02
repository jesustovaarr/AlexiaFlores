<h1 class="page-title">Nueva Promoción de Producto</h1>

<div class="card">
    <div class="card-header">
        Asignar Promoción a Producto
    </div>
    <div class="card-body">
        <form method="POST" action="promocion_producto.php?action=create">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_promocion" class="form-label">Promoción</label>
                        <select name="id_promocion" class="form-select" required>
                            <option value="" selected disabled>Seleccione una Promoción</option>
                            <?php foreach ($data['promociones'] as $promocion): ?>
                                <option value="<?php echo $promocion['id_promocion']; ?>"><?php echo htmlspecialchars($promocion['promocion']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select name="id_producto" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Producto</option>
                            <?php foreach ($data['productos'] as $producto): ?>
                                <option value="<?php echo $producto['id_producto']; ?>"><?php echo htmlspecialchars($producto['producto']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valor_descuento" class="form-label">Valor de Descuento</label>
                        <input type="number" step="0.01" class="form-control" id="valor_descuento" name="valor_descuento" placeholder="Escribe aquí el descuento" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <select name="activo" class="form-select" required>
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="true">Sí</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Asignación</button>
                <a href="promocion_producto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

