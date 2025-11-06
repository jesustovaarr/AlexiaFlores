<h1>Productos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="producto.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Descripción</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
      <th scope="col">Categoría</th>
      <th scope="col">Destacado</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $producto): ?>
        <tr>
        <th scope="row"><?php echo $producto['id_producto']; ?></th>
        <td><?php echo $producto['producto']; ?></td>
        <td><?php echo $producto['descripcion']; ?></td>
        <td><?php echo $producto['precio']; ?></td>
        <td><?php echo $producto['stock_disponible']; ?></td>
        <td><?php echo $producto['categoria']; ?></td>
        <td><?php if (empty($producto['id_destacado'])) {
          echo "No destacado";
        } else {
          echo $producto['destacado'];
        } ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="producto.php?action=update&id=<?php echo $producto['id_producto']; ?>" class="btn btn-warning">Editar</a>
                <a href ="producto.php?action=delete&id=<?php echo $producto['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>