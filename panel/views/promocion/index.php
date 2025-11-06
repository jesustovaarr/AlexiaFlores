<h1>Promociones</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="promocion.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Promoción</th>
      <th scope="col">Descripción</th>
      <th scope="col">Banner</th>
      <th scope="col">Tipo Descuento</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $promocion): ?>
        <tr>
        <th scope="row"><?php echo $promocion['id_promocion']; ?></th>
        <td><?php echo $promocion['promocion']; ?></td>
        <td><?php echo $promocion['descripcion']; ?></td>
        <td><img src="../images/promocion/<?php echo $promocion['imagen_banner']; ?>" width="100" height="100" class="rounded-circle" alt="promocion"/></td>
        <td><?php echo $promocion['tipo_descuento']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="promocion.php?action=update&id=<?php echo $promocion['id_promocion']; ?>" class="btn btn-warning">Editar</a>
                <a href ="promocion.php?action=delete&id=<?php echo $promocion['id_promocion']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>