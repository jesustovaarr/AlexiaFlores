<h1>Editar Destacado</h1>
<form method = "POST" action = "destacado.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="Destacado" class="form-label">Nombre del Destacado</label>
    <input type="text" class="form-control" id="destacado" name="destacado" value = "<?php echo $data['destacado']; ?>" placeholder="Escribe aqui el nombre" required = "required">
  </div>
  <div class="mb-3">
    <label for="Descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" value = "<?php echo $data['descripcion']; ?>" placeholder="Escribe aqui la descripción">
  </div>
<div class="mb-3">
  <label for="Fecha_Inicio" class="form-label">Fecha de Inicio</label>
  <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo date('Y-m-d\TH:i', strtotime($data['fecha_inicio'])); ?>">
</div>
<div class="mb-3">
  <label for="Fecha_Fin" class="form-label">Fecha de Fin</label>
  <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo date('Y-m-d\TH:i', strtotime($data['fecha_fin'])); ?>">
</div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
