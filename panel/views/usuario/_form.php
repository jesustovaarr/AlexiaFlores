<h1>Nuevo Usuario</h1>
<form method = "POST" action = "usuario.php?action=create">
  <div class="mb-3">
    <label for="correo" class="form-label">Correo Electronico</label>
    <input type="text" class="form-control" id="correo" name="correo" placeholder="Escribe aqui el correo electronico" required = "required">
  </div>

  <div class="mb-3">
    <label for="contrasena" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Escribe aqui tu contraseña" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
