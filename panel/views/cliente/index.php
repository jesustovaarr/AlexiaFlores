<h1>Clientes</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="cliente.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Fotografía</th>
      <th scope="col">Nombre Completo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Correo</th>
      <th scope="col">Género</th>
      <th scope="col">Fecha de Nacimiento</th>
      <th scope="col">Fecha de Registro</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $cliente): ?>
        <tr>
            <th scope="row"><?php echo $cliente['id_cliente']; ?></th>
            <td><img src="../images/cliente/<?php echo $cliente['foto_perfil']; ?>" width="100" height="100" class="rounded-circle" alt="cliente"/></td>
            <td><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido']; ?></td>
            <td><?php echo $cliente['telefono']; ?></td>
            <td><?php echo $cliente['correo']; ?></td>
            <td><?php echo $cliente['genero']; ?></td>
            <td><?php echo $cliente['fecha_nacimiento']; ?></td>
            <td><?php echo (new DateTime($cliente['fecha_registro']))->format('d/m/Y h:i A'); ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href ="cliente.php?action=update&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-warning">Editar</a>
                    <a href ="cliente.php?action=delete&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger">Eliminar</a>
                </div>   
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
