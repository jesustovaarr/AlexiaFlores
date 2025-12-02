<h1 class="page-title">Editar Imagen de Producto</h1>

<div class="card">
    <div class="card-header">
        Información de la Imagen
    </div>
    <div class="card-body">
        <form method="POST" action="imagen_producto.php?action=update&id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto</label>
                <select name="id_producto" id="id_producto" class="form-select" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>" <?php echo ($producto['id_producto'] == $data['id_producto']) ? 'selected' : ''; ?>><?php echo $producto['producto']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center mb-3">
                <img src="../images/producto/<?php echo $data['imagen_producto']; ?>" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" alt="Imagen actual del producto">
                <small class="d-block text-muted">Imagen actual</small>
            </div>
            <div class="mb-3">
                <label for="imagen_producto" class="form-label">Cambiar Imagen</label>
                <input type="file" class="form-control" id="imagen_producto" name="imagen_producto">
                <small class="form-text text-muted">Deje en blanco para conservar la imagen actual.</small>
            </div>
            <div class="mb-3">
                <label for="orden" class="form-label">Orden</label>
                <input type="number" class="form-control" id="orden" name="orden" value="<?php echo $data['orden']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="imagen_producto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



