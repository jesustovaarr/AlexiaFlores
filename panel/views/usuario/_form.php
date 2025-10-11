<h1>Nuevo Usuario</h1>
<form method = "POST" action = "usuario.php?action=create">
  <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" class="form-control" id="correo" name="correo" placeholder="Escribe aqui el correo" required = "required">
  </div>
  <div class="mb-3">
    <label for="contraseña" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Escribe aqui la contraseña" required = "required">
  </div>
  <div class="mb-3">
    <label for="id_rol" class="form-label">Rol</label>
    <select class="form-control" id="id_rol" name="id_rol">
        <?php foreach ($roles as $rol): ?>
            <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
