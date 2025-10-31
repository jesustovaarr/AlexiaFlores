<h1>Nueva Dirección</h1>
<form method="POST" action="direccion.php?action=create">
    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select name="id_cliente" class="form-control" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($clientes as $cliente) : ?>
                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="calle" class="form-label">Calle</label>
        <input type="text" class="form-control" id="calle" name="calle" required>
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" required>
    </div>
    <div class="mb-3">
        <label for="colonia" class="form-label">Colonia</label>
        <input type="text" class="form-control" id="colonia" name="colonia" required>
    </div>
    <div class="mb-3">
        <label for="ciudad" class="form-label">Ciudad</label>
        <input type="text" class="form-control" id="ciudad" name="ciudad" required>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" required>
    </div>
    <div class="mb-3">
        <label for="codigo_postal" class="form-label">Código Postal</label>
        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="1" id="es_principal" name="es_principal">
        <label class="form-check-label" for="es_principal">
            ¿Es su dirección principal?
        </label>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" name="enviar" value="Guardar">
    </div>
</form>