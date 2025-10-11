<h1>Editar Usuario</h1>
<form method = "POST" action = "usuario.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" class="form-control" id="correo" name="correo" value = "<?php echo $data['correo']; ?>" placeholder="Escribe aqui el correo" required = "required">
  </div>
  <div class="mb-3">
    <label for="contrasena" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" value = "<?php echo $data['contrasena']; ?>" placeholder="Escribe aqui la contraseña" required = "required">
  </div>
  <div class="mb-3">
    <label for="id_rol" class="form-label">Rol</label>
    <select class="form-control" id="id_rol" name="id_rol">
        <?php foreach ($roles as $rol): ?>
            <option value="<?php echo $rol['id_rol']; ?>" <?php echo ($rol['id_rol'] == $data['id_rol']) ? 'selected' : ''; ?>><?php echo $rol['rol']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
