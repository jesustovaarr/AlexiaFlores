<h1>Nueva Promoción</h1>
<form method="POST" action="promocion.php?action=create" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="promocion" class="form-label">Nombre de la Promoción</label>
    <input type="text" class="form-control" id="promocion" name="promocion" placeholder="Escribe aqui el nombre" required="required">
  </div>

  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe aqui la descripcion">
  </div>  

  <div class="mb-3">
    <label for="imagen_banner" class="form-label">Imagen o Banner</label>
    <input type="file" class="form-control" id="imagen_banner" name="imagen_banner">
  </div>

  <div class="mb-3">
    <label for="id_tipo_descuento" class="form-label">Tipo de Descuento</label>
    <select name="id_tipo_descuento" class="form-control">
      <option value="" selected disabled>Seleccione un Tipo de Descuento</option>
      <?php foreach ($data_tipo_descuento as $tipo_descuento): ?>
        <option value="<?php echo $tipo_descuento['id_tipo_descuento']; ?>"><?php echo $tipo_descuento['tipo_descuento']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>