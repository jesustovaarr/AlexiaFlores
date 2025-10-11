<h1>Nuevo Estado del Apartado</h1>
<form method = "POST" action = "estado_apartado.php?action=create">
  <div class="mb-3">
    <label for="EstadoApartado" class="form-label">Nombre del Estado del Apartado</label>
    <input type="text" class="form-control" id="estado_apartado" name="estado_apartado" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
