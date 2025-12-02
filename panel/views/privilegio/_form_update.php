<h1 class="page-title">Editar Privilegio</h1>

<div class="card">
    <div class="card-header">
        Información del Privilegio
    </div>
    <div class="card-body">
        <form method="POST" action="privilegio.php?action=update&id=<?php echo $data['id_privilegio']; ?>">
            <div class="mb-3">
                <label for="privilegio" class="form-label">Nombre del Privilegio</label>
                <input type="text" class="form-control" id="privilegio" name="privilegio" value="<?php echo $data['privilegio']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="privilegio.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


