<h1>Promoción de Productos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="promocion_producto.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Promoción</th>
      <th scope="col">Producto</th>
      <th scope="col">Valor de Descuento</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Fecha de Fin</th>
      <th scope="col">Activo</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $promocion_producto): ?>
        <tr>
            <td><?php echo $promocion_producto['promocion']; ?></td>
            <td><?php echo $promocion_producto['producto']; ?></td>
            <td><?php echo $promocion_producto['valor_descuento']; ?></td>
            <td><?php echo $promocion_producto['fecha_inicio']; ?></td>
            <td><?php echo $promocion_producto['fecha_fin']; ?></td>
            <td><?php echo $promocion_producto['activo'] ? 'Sí' : 'No'; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="promocion_producto.php?action=update&id_promocion=<?php echo $promocion_producto['id_promocion']; ?>&id_producto=<?php echo $promocion_producto['id_producto']; ?>" class="btn btn-warning">Editar</a>
                    <a href="promocion_producto.php?action=delete&id_promocion=<?php echo $promocion_producto['id_promocion']; ?>&id_producto=<?php echo $promocion_producto['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>