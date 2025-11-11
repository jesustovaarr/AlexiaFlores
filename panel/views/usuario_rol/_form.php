<h1>Nueva Asignación de Rol</h1>
<form method="POST" action="usuario_rol.php?action=create">
    <div class="mb-3">
        <label for="id_usuario" class="form-label">Usuario</label>
        <select name="id_usuario" class="form-control" required>
            <option value="" selected disabled>Seleccione un Usuario</option>
            <?php foreach ($data['usuarios'] as $usuario) : ?>
                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['correo']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_rol" class="form-label">Rol</label>
        <select name="id_rol" class="form-control" required>
            <option value="" selected disabled>Seleccione un Rol</option>
            <?php foreach ($data['roles'] as $rol) : ?>
                <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" name="enviar" value="Guardar">
    </div>
</form>
