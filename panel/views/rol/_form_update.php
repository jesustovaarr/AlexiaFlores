<h1 class="page-title">Editar Rol</h1>

<div class="card">
    <div class="card-header">
        Información del Rol
    </div>
    <div class="card-body">
        <form method="POST" action="rol.php?action=update&id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="rol" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $data['rol']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="rol.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



