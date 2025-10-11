<h1>Género</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="genero.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Géneroo</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $genero): ?>
        <tr>
        <th scope="row"><?php echo $genero['id_genero']; ?></th>
        <td><?php echo $genero['genero']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="genero.php?action=update&id=<?php echo $genero['id_genero']; ?>" class="btn btn-warning">Editar</a>
                <a href ="genero.php?action=delete&id=<?php echo $genero['id_genero']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>