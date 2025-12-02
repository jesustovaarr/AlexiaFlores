<h1 class="page-title">Editar Asignación de Privilegio</h1>

<div class="card">
    <div class="card-header">
        Modificar Privilegio del Rol
    </div>
    <div class="card-body">
        <form method="POST" action="rol_privilegio.php?action=update&id_rol=<?php echo $data['id_rol']; ?>&id_privilegio=<?php echo $data['id_privilegio']; ?>">
            <div class="mb-3">
                <label for="id_rol" class="form-label">Rol</label>
                <input type="text" class="form-control" id="id_rol" value="<?php echo $data['rol']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="id_privilegio_nuevo" class="form-label">Nuevo Privilegio</label>
                <select name="id_privilegio_nuevo" class="form-select" required>
                    <?php foreach ($data_privilegio as $privilegio): ?>
                        <option value="<?php echo $privilegio['id_privilegio']; ?>" <?php echo ($privilegio['id_privilegio'] == $data['id_privilegio']) ? 'selected' : ''; ?>><?php echo $privilegio['privilegio']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="rol_privilegio.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


