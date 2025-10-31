<h1>Nuevo Tipo de Descuento</h1>
<form method="POST" action="tipo_descuento.php?action=create">
  <div class="mb-3">
    <label for="tipo_descuento" class="form-label">Nombre del Tipo de Descuento</label>
    <input type="text" class="form-control" id="tipo_descuento" name="tipo_descuento" placeholder="Escribe aqui el nombre del tipo de descuento" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>