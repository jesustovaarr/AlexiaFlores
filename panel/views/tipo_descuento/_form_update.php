<h1>Editar Tipo de Descuento</h1>
<form method="POST" action="tipo_descuento.php?action=update&id=<?php echo $data['id_tipo_descuento']; ?>">
  <div class="mb-3">
    <label for="tipo_descuento" class="form-label">Nombre del Tipo de Descuento</label>
    <input type="text" class="form-control" id="tipo_descuento" name="tipo_descuento" value="<?php echo $data['tipo_descuento']; ?>" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>