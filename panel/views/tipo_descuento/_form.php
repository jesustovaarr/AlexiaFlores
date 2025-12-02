<h1 class="page-title">Nuevo Tipo de Descuento</h1>

<div class="card">
    <div class="card-header">
        Información del Tipo de Descuento
    </div>
    <div class="card-body">
        <form method="POST" action="tipo_descuento.php?action=create">
            <div class="mb-3">
                <label for="tipo_descuento" class="form-label">Tipo de Descuento</label>
                <input type="text" class="form-control" id="tipo_descuento" name="tipo_descuento" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Tipo de Descuento</button>
                <a href="tipo_descuento.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


