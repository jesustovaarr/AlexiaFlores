<h1>Nueva Asignación de Privilegio</h1>
<form method="POST" action="rol_privilegio.php?action=create">
    <div class="mb-3">
        <label for="id_rol" class="form-label">Rol</label>
        <select name="id_rol" class="form-control" required>
            <option value="">Seleccione un rol</option>
            <?php foreach ($data['roles'] as $rol) : ?>
                <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_privilegio" class="form-label">Privilegio</label>
        <select name="id_privilegio" class="form-control" required>
            <option value="">Seleccione un privilegio</option>
            <?php foreach ($data['privilegios'] as $privilegio) : ?>
                <option value="<?php echo $privilegio['id_privilegio']; ?>"><?php echo $privilegio['privilegio']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" name="enviar" value="Guardar">
    </div>
</form>