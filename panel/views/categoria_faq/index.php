<h1>Categorías de FAQ</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="categoria_faq.php?action=create" class="btn btn-success">Nueva</a>
</div>   
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Categoría de FAQ</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $categoria_faq): ?>
        <tr>
            <th scope="row"><?php echo $categoria_faq['id_categoria_faq']; ?></th>
            <td><?php echo $categoria_faq['categoria_faq']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href ="categoria_faq.php?action=update&id=<?php echo $categoria_faq['id_categoria_faq']; ?>" class="btn btn-warning">Editar</a>
                    <a href ="categoria_faq.php?action=delete&id=<?php echo $categoria_faq['id_categoria_faq']; ?>" class="btn btn-danger">Eliminar</a>
                </div>   
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>