<h1>Nuevo Detalle de Pedido</h1>
<form method = "POST" action = "detalle_pedido.php?action=create">

  <div class="mb-3">
    <label for="id_pedido" class="form-label">Pedido</label>
    <select name="id_pedido" class="form-control">
      <?php foreach ($data_pedido as $pedido): ?>
        <option value="<?php echo $pedido['id_pedido']; ?>"><?php echo $pedido['id_pedido']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="id_producto" class="form-label">Producto</label>
    <select name="id_producto" class="form-control">
      <option value="" selected disabled>Seleccione un Producto</option>
      <?php foreach ($data_producto as $producto): ?>
        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['producto']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" name="cantidad"  placeholder="Escribe aqui la cantidad" required = "required">
  </div>

  <div class="mb-3">
    <label for="precio_unitario" class="form-label">Precio Unitario</label>
    <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="Escribe aqui el precio unitario con dos decimales" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>