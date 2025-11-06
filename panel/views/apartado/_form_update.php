<h1>Editar Apartado</h1>
<form method = "POST" action = "apartado.php?action=update&id=<?php echo $id; ?>">

  <div class="mb-3">
    <label for="id_cliente" class="form-label">Cliente</label>
    <select name="id_cliente" class="form-control">
      <?php foreach ($data_cliente as $cliente): ?>
        <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($cliente['id_cliente'] == $data['id_cliente']) ? 'selected' : ''; ?>><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="id_producto" class="form-label">Producto</label>
    <select name="id_producto" class="form-control">
      <?php foreach ($data_producto as $producto): ?>
        <option value="<?php echo $producto['id_producto']; ?>" <?php echo ($producto['id_producto'] == $data['id_producto']) ? 'selected' : ''; ?>><?php echo $producto['producto']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['cantidad']; ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="fecha_apartado" class="form-label">Fecha de Apartado</label>
    <input type="datetime-local" class="form-control" id="fecha_apartado" name="fecha_apartado" value="<?php echo date('Y-m-d\TH:i', strtotime($data['fecha_apartado'])); ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="fecha_limite" class="form-label">Fecha Límite</label>
    <input type="datetime-local" class="form-control" id="fecha_limite" name="fecha_limite" value="<?php echo date('Y-m-d\TH:i', strtotime($data['fecha_limite'])); ?>" required = "required">
  </div>

  <div class="mb-3">
    <label for="id_estado_apartado" class="form-label">Estado del Apartado</label>
    <select name="id_estado_apartado" class="form-control">
      <?php foreach ($data_estado_apartado as $estado_apartado): ?>
        <option value="<?php echo $estado_apartado['id_estado_apartado']; ?>" <?php echo ($estado_apartado['id_estado_apartado'] == $data['id_estado_apartado']) ? 'selected' : ''; ?>><?php echo $estado_apartado['estado_apartado']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>