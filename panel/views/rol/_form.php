<h1>Nuevo Rol</h1>
<form method = "POST" action = "rol.php?action=create">
  <div class="mb-3">
    <label for="Rol" class="form-label">Nombre del Rol</label>
    <input type="text" class="form-control" id="rol" name="rol" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
