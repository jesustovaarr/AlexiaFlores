<h1>Imágenes de Productos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="imagen_producto.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Imagen</th>
      <th scope="col">Orden</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $imagen_producto): ?>
        <tr>
        <th scope="row"><?php echo $imagen_producto['id_imagen']; ?></th>
        <td><?php echo $imagen_producto['producto']; ?></td>
        <td><img src="../images/producto/<?php echo $imagen_producto['imagen_producto']; ?>" width="100" height="100" class="rounded-circle" alt="producto"/></td>
        <td><?php echo $imagen_producto['orden']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="imagen_producto.php?action=update&id=<?php echo $imagen_producto['id_imagen']; ?>" class="btn btn-warning">Editar</a>
                <a href ="imagen_producto.php?action=delete&id=<?php echo $imagen_producto['id_imagen']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>