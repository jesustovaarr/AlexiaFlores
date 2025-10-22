<h1>Modificar Usuario</h1>
<form method = "POST" action = "usuario.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="correo" class="form-label">Correo Electronico</label>
    <input type="email" class="form-control" id="correo" name="correo" value = "<?php echo $data['correo']; ?>" placeholder="Escribe aqui el correo electronico" required = "required">
  </div>

  <div class="mb-3">
    <label for="contraseña" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" value = "<?php echo $data['contrasena']; ?>" placeholder="Escribe aqui tu contraseña" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>