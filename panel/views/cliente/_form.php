<h1 class="page-title">Nuevo Cliente</h1>

<div class="card">
    <div class="card-header">
        Información del Cliente
    </div>
    <div class="card-body">
        <form method="POST" action="cliente.php?action=create" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="primer_apellido" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej. 5512345678" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_genero" class="form-label">Género</label>
                        <select class="form-select" id="id_genero" name="id_genero">
                            <option value="" selected disabled>Seleccione un Género</option>
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cliente</button>
                <a href="cliente.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



