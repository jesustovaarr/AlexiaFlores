<h1>Nuevo Cliente</h1>
<form method = "POST" action = "cliente.php?action=create" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
  </div>

  <div class="mb-3">
    <label for="primer_apellido" class="form-label">Primer Apellido</label>
    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Escribe aqui el primer apellido" required = "required">
  </div>

  <div class="mb-3">
    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Escribe aqui el segundo apellido" required = "required">
  </div>

  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <label for="correo" class="form-label">Correo Electronico</label>
    <input type="text" class="form-control" id="correo" name="correo" placeholder="Escribe aqui el correo electronico" required = "required">
  </div>

  <div class="mb-3">
    <label for="contraseña" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Escribe aqui la contraseña" required = "required">
  </div>

  <div class="mb-3">
    <label for="telefono" class="form-label">Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Escribe aqui el telefono" required = "required">
  </div>

  <div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required = "required">
  </div>

  <div class="mb-3">
    <label for="id_genero" class="form-label">Género</label>
    <select class="form-control" id="id_genero" name="id_genero">
        <option value="" selected disabled>Seleccione un Género</option>
        <?php foreach ($generos as $genero): ?>
            <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
