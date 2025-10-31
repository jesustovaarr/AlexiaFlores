<h1>Privilegios</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="privilegio.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Privilegio</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $privilegio): ?>
        <tr>
            <th scope="row"><?php echo $privilegio['id_privilegio']; ?></th>
            <td><?php echo $privilegio['privilegio']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href ="privilegio.php?action=update&id=<?php echo $privilegio['id_privilegio']; ?>" class="btn btn-warning">Editar</a>
                    <a href ="privilegio.php?action=delete&id=<?php echo $privilegio['id_privilegio']; ?>" class="btn btn-danger">Eliminar</a>
                </div>   
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>