<h1>Usuarios</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="usuario.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Correo</th>
      <th scope="col">Rol</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $usuario): ?>
        <tr>
        <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
        <td><?php echo $usuario['correo']; ?></td>
        <td><?php echo $usuario['rol']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="usuario.php?action=update&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-warning">Editar</a>
                <a href ="usuario.php?action=delete&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>