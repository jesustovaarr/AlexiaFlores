<h1 class="page-title">Editar Promoción</h1>

<div class="card">
    <div class="card-header">
        Información de la Promoción
    </div>
    <div class="card-body">
        <form method="POST" action="promocion.php?action=update&id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <img src="../images/promocion/<?php echo $data['imagen_banner']; ?>" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" alt="Banner de Promoción Actual">
                <small class="d-block text-muted">Imagen actual del banner</small>
            </div>
            <div class="mb-3">
                <label for="promocion" class="form-label">Nombre de la Promoción</label>
                <input type="text" class="form-control" id="promocion" name="promocion" value="<?php echo $data['promocion']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $data['descripcion']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen_banner" class="form-label">Cambiar Imagen o Banner</label>
                <input type="file" class="form-control" id="imagen_banner" name="imagen_banner">
                <small class="form-text text-muted">Deje en blanco para conservar la imagen actual.</small>
            </div>
            <div class="mb-3">
                <label for="id_tipo_descuento" class="form-label">Tipo de Descuento</label>
                <select name="id_tipo_descuento" class="form-select" required>
                    <?php foreach ($data_tipo_descuento as $tipo_descuento): ?>
                        <option value="<?php echo $tipo_descuento['id_tipo_descuento']; ?>" <?php echo ($tipo_descuento['id_tipo_descuento'] == $data['id_tipo_descuento']) ? 'selected' : ''; ?>>
                            <?php echo $tipo_descuento['tipo_descuento']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="promocion.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


