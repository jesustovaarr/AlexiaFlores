<h1>Métodos de Pago</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="metodo_pago.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Método de Pago</th>
      <th scope="col">Opciones</th> </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $metodo_pago): ?>
        <tr>
        <th scope="row"><?php echo $metodo_pago['id_metodo_pago']; ?></th>
        <td><?php echo $metodo_pago['metodo_pago']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href ="metodo_pago.php?action=update&id=<?php echo $metodo_pago['id_metodo_pago']; ?>" class="btn btn-warning">Editar</a>
                <a href ="metodo_pago.php?action=delete&id=<?php echo $metodo_pago['id_metodo_pago']; ?>" class="btn btn-danger">Eliminar</a>
            </div>   
        </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>