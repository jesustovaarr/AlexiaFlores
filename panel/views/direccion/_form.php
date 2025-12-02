<h1 class="page-title">Nueva Dirección</h1>

<div class="card">
    <div class="card-header">
        Información de la Dirección
    </div>
    <div class="card-body">
        <form method="POST" action="direccion.php?action=create">
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select name="id_cliente" class="form-select" required>
                    <option value="" selected disabled>Seleccione un Cliente</option>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Escribe aquí el nombre de la calle" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número Exterior/Interior</label>
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Ej. 123 A" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="colonia" class="form-label">Colonia</label>
                <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Escribe aquí la colonia" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Escribe aquí la ciudad" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" placeholder="Escribe aquí el estado" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="codigo_postal" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="Escribe aquí el código postal" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" id="es_principal" name="es_principal">
                <label class="form-check-label" for="es_principal">
                    ¿Es la dirección principal del cliente?
                </label>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Dirección</button>
                <a href="direccion.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


