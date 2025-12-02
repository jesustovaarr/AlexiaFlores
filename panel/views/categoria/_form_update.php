<h1 class="page-title">Editar Categoría</h1>

<div class="card">
    <div class="card-header">
        Información de la Categoría
    </div>
    <div class="card-body">
        <form method="POST" action="categoria.php?action=update&id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="categoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $data['categoria']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $data['descripcion']; ?></textarea>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="categoria.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



