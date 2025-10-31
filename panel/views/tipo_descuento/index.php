<h1>Tipos de Descuento</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="tipo_descuento.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo de Descuento</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $tipo_descuento): ?>
        <tr>
            <th scope="row"><?php echo $tipo_descuento['id_tipo_descuento']; ?></th>
            <td><?php echo $tipo_descuento['tipo_descuento']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href ="tipo_descuento.php?action=update&id=<?php echo $tipo_descuento['id_tipo_descuento']; ?>" class="btn btn-warning">Editar</a>
                    <a href ="tipo_descuento.php?action=delete&id=<?php echo $tipo_descuento['id_tipo_descuento']; ?>" class="btn btn-danger">Eliminar</a>
                </div>   
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>