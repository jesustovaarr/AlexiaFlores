<h1 class="page-title">Nuevo Usuario</h1>

<div class="card">
    <div class="card-header">
        Información del Usuario
    </div>
    <div class="card-body">
        <form method="POST" action="usuario.php?action=create">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Usuario</button>
                <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



