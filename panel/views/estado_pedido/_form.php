<h1>Nuevo Estado del Pedido</h1>
<form method = "POST" action = "estado_pedido.php?action=create">
  <div class="mb-3">
    <label for="EstadoPedido" class="form-label">Nombre del Estado del Pedido</label>
    <input type="text" class="form-control" id="estado_pedido" name="estado_pedido" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
