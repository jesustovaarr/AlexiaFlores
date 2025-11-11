<h1>Nuevo Producto</h1>
<form method = "POST" action = "producto.php?action=create">
  <div class="mb-3">
    <label for="producto" class="form-label">Nombre del Producto</label>
    <input type="text" class="form-control" id="producto" name="producto" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe aqui la descripcion">
  </div>  

  <div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Escribe aqui el precio" required = "required">
  </div>

  <div class="mb-3">
    <label for="stock_disponible" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock_disponible" name="stock_disponible" placeholder="Define aqui el stock" required = "required">
  </div>

  <div class="mb-3">
    <label for="id_categoria" class="form-label">Categoría</label>
    <select class="form-control" id="id_categoria" name="id_categoria">
      <option value="" selected disabled>Seleccione una Categoría</option>
        <?php foreach ($data_categoria as $categoria): ?>
            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['categoria']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="id_destacado" class="form-label">Destacado</label>
    <select class="form-control" id="id_destacado" name="id_destacado">
        <option value="">No destacado</option>
        <?php foreach ($data_destacado as $destacado): ?>
            <option value="<?php echo $destacado['id_destacado']; ?>"><?php echo $destacado['destacado']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
