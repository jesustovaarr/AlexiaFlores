<h1>Categorías</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="categoria.php?action=create" class="btn btn-success">Nuevo</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Categoría</th>
      <th scope="col">Descripción</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $categoria): ?>
        <tr>
        <th scope="row"><?php echo $categoria['id_categoria']; ?></th>
        <td><?php echo $categoria['categoria']; ?></td>
        <td><?php echo $categoria['descripcion']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="categoria.php?action=update&id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-warning">Editar</a>
                <a href ="categoria.php?action=delete&id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>