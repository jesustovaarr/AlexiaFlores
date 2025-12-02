<h1 class="page-title">Modificar Usuario</h1>

<div class="card">
    <div class="card-header">
        Información del Usuario
    </div>
    <div class="card-body">
        <form method="POST" action="usuario.php?action=update&id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $data['correo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
                <div class="form-text">Deje este campo en blanco para no modificar la contraseña actual.</div>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


