<h1>Editar Imagen de Producto</h1>
<form method = "POST" action = "imagen_producto.php?action=update&id=<?php echo $id; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="producto" class="form-label">Producto</label>
    <select name="id_producto" id="id_producto" class="form-control">
        <?php foreach ($productos as $producto): ?>
            <option value="<?php echo $producto['id_producto']; ?>" <?php echo ($producto['id_producto'] == $data['id_producto']) ? 'selected' : ''; ?>><?php echo $producto['producto']; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="imagen_producto" class="form-label">Imagen</label>
    <input type="file" class="form-control" id="imagen_producto" name="imagen_producto">
    <img src="../images/producto/<?php echo $data['imagen_producto']; ?>" alt="" width="100px">
  </div>

  <div class="mb-3">
    <label for="orden" class="form-label">Orden</label>
    <input type="number" class="form-control" id="orden" name="orden" value="<?php echo $data['orden']; ?>" placeholder="Escribe aqui el orden" required = "required">
  </div>  

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
