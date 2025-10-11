<h1>Editar Cliente</h1>
<form method = "POST" action = "cliente.php?action=update&id=<?php echo $id; ?>" enctype="multipart/form-data">

  <div class="text-center">
    <img src="../images/cliente/<?php echo $data['foto_perfil']; ?>" width="200" height="200" class="rounded-circle" alt="cliente">
  </div>

    <div class="mb-3">
    <label for="Institucion" class="form-label"></label>
    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
  </div>

  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required = "required">
  </div>
  <div class="mb-3">
    <label for="primer_apellido" class="form-label">Primer Apellido</label>
    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo $data['primer_apellido']; ?>" required = "required">
  </div>
  <div class="mb-3">
    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo $data['segundo_apellido']; ?>" required = "required">
  </div>
  <div class="mb-3">
    <label for="telefono" class="form-label">Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $data['telefono']; ?>" required = "required">
  </div>
  <div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $data['fecha_nacimiento']; ?>" required = "required">
  </div>
  <div class="mb-3">
    <label for="id_usuario" class="form-label">Usuario</label>
    <select class="form-control" id="id_usuario" name="id_usuario">
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo ($usuario['id_usuario'] == $data['id_usuario']) ? 'selected' : ''; ?>><?php echo $usuario['correo']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="id_genero" class="form-label">Genero</label>
    <select class="form-control" id="id_genero" name="id_genero">
        <?php foreach ($generos as $genero): ?>
            <option value="<?php echo $genero['id_genero']; ?>" <?php echo ($genero['id_genero'] == $data['id_genero']) ? 'selected' : ''; ?>><?php echo $genero['genero']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
