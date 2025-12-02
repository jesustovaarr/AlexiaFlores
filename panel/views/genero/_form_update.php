<h1 class="page-title">Editar Género</h1>

<div class="card">
    <div class="card-header">
        Información del Género
    </div>
    <div class="card-body">
        <form method="POST" action="genero.php?action=update&id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="genero" class="form-label">Nombre del Género</label>
                <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $data['genero']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="genero.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



