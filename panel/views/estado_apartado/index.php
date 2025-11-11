<h1>Estados de Apartado</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="estado_apartado.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Estado del Apartado</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $estado_apartado): ?>
        <tr>
        <th scope="row"><?php echo $estado_apartado['id_estado_apartado']; ?></th>
        <td><?php echo $estado_apartado['estado_apartado']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="estado_apartado.php?action=update&id=<?php echo $estado_apartado['id_estado_apartado']; ?>" class="btn btn-warning">Editar</a>
                <a href ="estado_apartado.php?action=delete&id=<?php echo $estado_apartado['id_estado_apartado']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>