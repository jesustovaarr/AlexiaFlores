<h1>Pedidos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="pedido.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cliente</th>
      <th scope="col">Fecha del Pedido</th>
      <th scope="col">Total del Pedido</th>
      <th scope="col">Estado del Pedido</th>
      <th scope="col">Método de Pago</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $pedido): ?>
        <tr>
        <th scope="row"><?php echo $pedido['id_pedido']; ?></th>
        <td><?php echo $pedido['nombre']; ?></td>
        <td><?php echo $pedido['fecha_pedido']; ?></td>
        <td><?php echo $pedido['total_pedido']; ?></td>
        <td><?php echo $pedido['estado_pedido']; ?></td>
        <td><?php echo $pedido['metodo_pago']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="pedido.php?action=update&id=<?php echo $pedido['id_pedido']; ?>" class="btn btn-warning">Editar</a>
                <a href ="pedido.php?action=delete&id=<?php echo $pedido['id_pedido']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>