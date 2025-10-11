<h1>Roles</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="rol.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Rol</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $rol): ?>
        <tr>
        <th scope="row"><?php echo $rol['id_rol']; ?></th>
        <td><?php echo $rol['rol']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="rol.php?action=update&id=<?php echo $rol['id_rol']; ?>" class="btn btn-warning">Editar</a>
                <a href ="rol.php?action=delete&id=<?php echo $rol['id_rol']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>