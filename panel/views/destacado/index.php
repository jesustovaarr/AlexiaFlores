<h1>Destacados</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="destacado.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Destacado</th>
      <th scope="col">Descripción</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Fecha de Fin</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $destacado): ?>
        <tr>
        <th scope="row"><?php echo $destacado['id_destacado']; ?></th>
        <td><?php echo $destacado['destacado']; ?></td>
        <td><?php echo $destacado['descripcion']; ?></td>
        <td><?php echo $destacado['fecha_inicio']; ?></td>
        <td><?php echo $destacado['fecha_fin']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="destacado.php?action=update&id=<?php echo $destacado['id_destacado']; ?>" class="btn btn-warning">Editar</a>
                <a href ="destacado.php?action=delete&id=<?php echo $destacado['id_destacado']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>