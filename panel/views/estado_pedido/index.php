<h1>Estados de Pedido</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="estado_pedido.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Estado del Pedido</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $estado_pedido): ?>
        <tr>
        <th scope="row"><?php echo $estado_pedido['id_estado_pedido']; ?></th>
        <td><?php echo $estado_pedido['estado_pedido']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="estado_pedido.php?action=update&id=<?php echo $estado_pedido['id_estado_pedido']; ?>" class="btn btn-warning">Editar</a>
                <a href ="estado_pedido.php?action=delete&id=<?php echo $estado_pedido['id_estado_pedido']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>