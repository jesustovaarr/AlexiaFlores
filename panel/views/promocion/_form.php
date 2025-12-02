<h1 class="page-title">Nueva Promoción</h1>

<div class="card">
    <div class="card-header">
        Información de la Promoción
    </div>
    <div class="card-body">
        <form method="POST" action="promocion.php?action=create" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="promocion" class="form-label">Nombre de la Promoción</label>
                <input type="text" class="form-control" id="promocion" name="promocion" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen_banner" class="form-label">Imagen o Banner</label>
                <input type="file" class="form-control" id="imagen_banner" name="imagen_banner">
            </div>
            <div class="mb-3">
                <label for="id_tipo_descuento" class="form-label">Tipo de Descuento</label>
                <select name="id_tipo_descuento" class="form-select" required>
                    <option value="" selected disabled>Seleccione un Tipo de Descuento</option>
                    <?php foreach ($data_tipo_descuento as $tipo_descuento): ?>
                        <option value="<?php echo $tipo_descuento['id_tipo_descuento']; ?>"><?php echo $tipo_descuento['tipo_descuento']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Promoción</button>
                <a href="promocion.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


