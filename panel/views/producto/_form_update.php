<h1>Editar Producto</h1>
<form method = "POST" action = "producto.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="producto" class="form-label">Nombre del Producto</label>
    <input type="text" class="form-control" id="producto" name="producto" value = "<?php echo $data['producto']; ?>" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" value = "<?php echo $data['descripcion']; ?>" placeholder="Escribe aqui la descripcion">
  </div>  

  <div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value = "<?php echo $data['precio']; ?>" placeholder="Escribe aqui el precio" required = "required">
  </div>

  <div class="mb-3">
    <label for="stock_disponible" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock_disponible" name="stock_disponible" value = "<?php echo $data['stock_disponible']; ?>" placeholder="Escribe aqui el stock" required = "required">
  </div>

  <div class="mb-3">
    <label for="id_categoria" class="form-label">Categoría</label>
    <select class="form-control" id="id_categoria" name="id_categoria">
        <?php foreach ($data_categoria as $categoria): ?>
            <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo ($categoria['id_categoria'] == $data['id_categoria']) ? 'selected' : ''; ?>><?php echo $categoria['categoria']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="id_destacado" class="form-label">Destacado</label>
    <select class="form-control" id="id_destacado" name="id_destacado">
        <option value="">No destacado</option>
        <?php foreach ($data_destacado as $destacado): ?>
            <option value="<?php echo $destacado['id_destacado']; ?>" <?php echo ($destacado['id_destacado'] == $data['id_destacado']) ? 'selected' : ''; ?>><?php echo $destacado['destacado']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
