<h1>Nueva Promoción de Producto</h1>
<form method="POST" action="promocion_producto.php?action=create">
    <div class="mb-3">
        <label for="id_promocion" class="form-label">Promoción</label>
        <select name="id_promocion" class="form-control" required="required">
            <option value="" selected disabled>Seleccione una Promoción</option>
            <?php foreach ($data['promociones'] as $promocion): ?>
                <option value="<?php echo $promocion['id_promocion']; ?>"><?php echo $promocion['promocion']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_producto" class="form-label">Producto</label>
        <select name="id_producto" class="form-control" required="required">
            <option value="" selected disabled>Seleccione un Producto</option>
            <?php foreach ($data['productos'] as $producto): ?>
                <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['producto']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="valor_descuento" class="form-label">Valor de Descuento</label>
        <input type="number" step="0.01" class="form-control" id="valor_descuento" name="valor_descuento"  placeholder="Escribe aqui el descuento con dos decimales" required="required">
    </div>

    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required="required">
    </div>

    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required="required">
    </div>

    <div class="mb-3">
        <label for="activo" class="form-label">Activo</label>
        <select name="activo" class="form-control" required="required">
            <option value="" selected disabled>Seleccione una opcion</option>
            <option value="true">Sí</option>
            <option value="false">No</option>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
    </div>
</form>