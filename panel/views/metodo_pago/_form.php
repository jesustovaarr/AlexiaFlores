<h1>Nuevo Método de Pago</h1>
<form method = "POST" action = "metodo_pago.php?action=create">
  <div class="mb-3">
    <label for="MetodoPago" class="form-label">Nombre del Método de Pago</label>
    <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
