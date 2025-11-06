<h1>Preguntas Frecuentes</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="faq.php?action=create" class="btn btn-success">Nueva</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pregunta</th>
      <th scope="col">Respuesta</th>
      <th scope="col">Categoría</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $faq): ?>
        <tr>
            <th scope="row"><?php echo $faq['id_faq']; ?></th>
            <td><?php echo $faq['pregunta']; ?></td>
            <td><?php echo $faq['respuesta']; ?></td>
            <td><?php echo $faq['categoria_faq']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href ="faq.php?action=update&id=<?php echo $faq['id_faq']; ?>" class="btn btn-warning">Editar</a>
                    <a href ="faq.php?action=delete&id=<?php echo $faq['id_faq']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>