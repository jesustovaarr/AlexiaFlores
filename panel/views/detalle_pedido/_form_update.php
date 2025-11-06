<h1>Editar Detalle de Pedido</h1>
<form method = "POST" action = "detalle_pedido.php?action=update&id_pedido=<?php echo $data['id_pedido']; ?>&id_producto=<?php echo $data['id_producto']; ?>">

  <div class="mb-3">
    <label for="id_pedido" class="form-label">Pedido</label>
    <input type="text" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $data['id_pedido']; ?>" readonly>
  </div>

  <div class="mb-3">
    <label for="id_producto" class="form-label">Producto</label>
    <input type="text" class="form-control" id="id_producto" name="id_producto" value="<?php echo $data['id_producto']; ?>" readonly>
  </div>

  <div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['cantidad']; ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="precio_unitario" class="form-label">Precio Unitario</label>
    <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" value="<?php echo $data['precio_unitario']; ?>" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>