<h1 class="page-title">Editar Asignación de Rol</h1>

<div class="card">
    <div class="card-header">
        Modificar Rol del Usuario
    </div>
    <div class="card-body">
        <form method="POST" action="usuario_rol.php?action=update&id_usuario=<?php echo $data['id_usuario']; ?>&id_rol=<?php echo $data['id_rol']; ?>">
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $data['correo']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="id_rol_nuevo" class="form-label">Nuevo Rol</label>
                <select name="id_rol_nuevo" class="form-select" required>
                    <?php foreach ($data_rol as $rol): ?>
                        <option value="<?php echo $rol['id_rol']; ?>" <?php echo ($rol['id_rol'] == $data['id_rol']) ? 'selected' : ''; ?>><?php echo $rol['rol']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="usuario_rol.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


