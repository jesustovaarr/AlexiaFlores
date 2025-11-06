<h1>Apartados</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="apartado.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cliente</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Fecha de Apartado</th>
      <th scope="col">Fecha Límite</th>
      <th scope="col">Estado</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $apartado): ?>
        <tr>
        <th scope="row"><?php echo $apartado['id_apartado']; ?></th>
        <td><?php echo $apartado['nombre']; ?></td>
        <td><?php echo $apartado['producto']; ?></td>
        <td><?php echo $apartado['cantidad']; ?></td>
        <td><?php echo $apartado['fecha_apartado']; ?></td>
        <td><?php echo $apartado['fecha_limite']; ?></td>
        <td><?php echo $apartado['estado_apartado']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="apartado.php?action=update&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-warning">Editar</a>
                <a href ="apartado.php?action=delete&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>