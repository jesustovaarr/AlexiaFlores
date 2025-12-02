<h1 class="page-title">Nueva Asignación de Privilegio</h1>

<div class="card">
    <div class="card-header">
        Asignar Privilegio a Rol
    </div>
    <div class="card-body">
        <form method="POST" action="rol_privilegio.php?action=create">
            <div class="mb-3">
                <label for="id_rol" class="form-label">Rol</label>
                <select name="id_rol" class="form-select" required>
                    <option value="" selected disabled>Seleccione un Rol</option>
                    <?php foreach ($data['roles'] as $rol) : ?>
                        <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_privilegio" class="form-label">Privilegio</label>
                <select name="id_privilegio" class="form-select" required>
                    <option value="" selected disabled>Seleccione un Privilegio</option>
                    <?php foreach ($data['privilegios'] as $privilegio) : ?>
                        <option value="<?php echo $privilegio['id_privilegio']; ?>"><?php echo $privilegio['privilegio']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Asignar Privilegio</button>
                <a href="rol_privilegio.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


