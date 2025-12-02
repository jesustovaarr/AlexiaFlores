<h1 class="page-title">Editar Cliente</h1>

<div class="card">
    <div class="card-header">
        Información del Cliente
    </div>
    <div class="card-body">
        <form method="POST" action="cliente.php?action=update&id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <img src="<?php echo $data['imagen_base64']; ?>" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto de Perfil Actual">
                <small class="d-block text-muted">Foto de perfil actual</small>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="primer_apellido" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo $data['primer_apellido']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo $data['segundo_apellido']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $data['telefono']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $data['fecha_nacimiento']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_genero" class="form-label">Género</label>
                        <select class="form-select" id="id_genero" name="id_genero">
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?php echo $genero['id_genero']; ?>" <?php echo ($genero['id_genero'] == $data['id_genero']) ? 'selected' : ''; ?>><?php echo $genero['genero']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto_perfil" class="form-label">Cambiar Foto de Perfil</label>
                <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                <small class="form-text text-muted">Deje en blanco para conservar la imagen actual.</small>
            </div>
             <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario Asociado (Correo)</label>
                <select class="form-select" id="id_usuario" name="id_usuario">
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo ($usuario['id_usuario'] == $data['id_usuario']) ? 'selected' : ''; ?>><?php echo $usuario['correo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="cliente.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



