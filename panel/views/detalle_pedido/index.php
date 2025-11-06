<h1>Detalle de Pedidos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="detalle_pedido.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID del Pedido</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio Unitario</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $detalle_pedido): ?>
        <tr>
        <th scope="row"><?php echo $detalle_pedido['id_pedido']; ?></th>
        <td><?php echo $detalle_pedido['producto']; ?></td>
        <td><?php echo $detalle_pedido['cantidad']; ?></td>
        <td><?php echo $detalle_pedido['precio_unitario']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="detalle_pedido.php?action=update&id_pedido=<?php echo $detalle_pedido['id_pedido']; ?>&id_producto=<?php echo $detalle_pedido['id_producto']; ?>" class="btn btn-warning">Editar</a>
                <a href ="detalle_pedido.php?action=delete&id_pedido=<?php echo $detalle_pedido['id_pedido']; ?>&id_producto=<?php echo $detalle_pedido['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>