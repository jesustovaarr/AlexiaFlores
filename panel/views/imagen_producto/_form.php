<h1 class="page-title">Nueva Imagen de Producto</h1>

<div class="card">
    <div class="card-header">
        Información de la Imagen
    </div>
    <div class="card-body">
        <form method="POST" action="imagen_producto.php?action=create" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto</label>
                <select name="id_producto" id="id_producto" class="form-select" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['producto']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagen_producto" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen_producto" name="imagen_producto" required>
            </div>
            <div class="mb-3">
                <label for="orden" class="form-label">Orden</label>
                <input type="number" class="form-control" id="orden" name="orden" placeholder="Escribe aquí el orden" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Imagen</button>
                <a href="imagen_producto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



