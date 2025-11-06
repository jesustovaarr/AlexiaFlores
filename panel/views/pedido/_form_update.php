<h1>Editar Pedido</h1>
<form method = "POST" action = "pedido.php?action=update&id=<?php echo $id; ?>">

  <div class="mb-3">
    <label for="id_cliente" class="form-label">Cliente</label>
    <select name="id_cliente" class="form-control">
      <?php foreach ($data_cliente as $cliente): ?>
        <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($cliente['id_cliente'] == $data['id_cliente']) ? 'selected' : ''; ?>><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="fecha_pedido" class="form-label">Fecha del Pedido</label>
    <input type="datetime-local" class="form-control" id="fecha_pedido" name="fecha_pedido" value="<?php echo date('Y-m-d\TH:i', strtotime($data['fecha_pedido'])); ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="total_pedido" class="form-label">Total del Pedido</label>
    <input type="number" step="0.01" class="form-control" id="total_pedido" name="total_pedido" value="<?php echo $data['total_pedido']; ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="id_estado_pedido" class="form-label">Estado del Pedido</label>
    <select name="id_estado_pedido" class="form-control">
      <?php foreach ($data_estado_pedido as $estado_pedido): ?>
        <option value="<?php echo $estado_pedido['id_estado_pedido']; ?>" <?php echo ($estado_pedido['id_estado_pedido'] == $data['id_estado_pedido']) ? 'selected' : ''; ?>><?php echo $estado_pedido['estado_pedido']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="id_metodo_pago" class="form-label">Método de Pago</label>
    <select name="id_metodo_pago" class="form-control">
      <?php foreach ($data_metodo_pago as $metodo_pago): ?>
        <option value="<?php echo $metodo_pago['id_metodo_pago']; ?>" <?php echo ($metodo_pago['id_metodo_pago'] == $data['id_metodo_pago']) ? 'selected' : ''; ?>><?php echo $metodo_pago['metodo_pago']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>