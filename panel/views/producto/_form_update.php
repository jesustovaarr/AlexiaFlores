<h1 class="page-title">Editar Producto</h1>

<div class="card">
    <div class="card-header">
        Información del Producto
    </div>
    <div class="card-body">
        <form method="POST" action="producto.php?action=update&id=<?php echo $id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="producto" name="producto" value="<?php echo $data['producto']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select class="form-select" id="id_categoria" name="id_categoria" required>
                            <?php foreach ($data_categoria as $categoria): ?>
                                <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo ($categoria['id_categoria'] == $data['id_categoria']) ? 'selected' : ''; ?>><?php echo $categoria['categoria']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $data['descripcion']; ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $data['precio']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock_disponible" class="form-label">Stock Disponible</label>
                        <input type="number" class="form-control" id="stock_disponible" name="stock_disponible" value="<?php echo $data['stock_disponible']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="id_destacado" class="form-label">Destacado</label>
                <select class="form-select" id="id_destacado" name="id_destacado">
                    <option value="">No destacado</option>
                    <?php foreach ($data_destacado as $destacado): ?>
                        <option value="<?php echo $destacado['id_destacado']; ?>" <?php echo ($destacado['id_destacado'] == $data['id_destacado']) ? 'selected' : ''; ?>><?php echo $destacado['destacado']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="producto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



