<h1>Editar Pregunta Frecuente</h1>
<form method="POST" action="faq.php?action=update&id=<?php echo $data['id_faq']; ?>">
  <div class="mb-3">
    <label for="pregunta" class="form-label">Pregunta</label>
    <input type="text" class="form-control" id="pregunta" name="pregunta" value="<?php echo $data['pregunta']; ?>" required="required">
  </div>

  <div class="mb-3">
    <label for="respuesta" class="form-label">Respuesta</label>
    <textarea class="form-control" id="respuesta" name="respuesta" rows="3" required="required"><?php echo $data['respuesta']; ?></textarea>
  </div>

  <div class="mb-3">
    <label for="id_categoria_faq" class="form-label">Categoría</label>
    <select class="form-select" name="id_categoria_faq" id="id_categoria_faq">
      <?php foreach ($data_categoria_faq as $categoria_faq): ?>
        <option value="<?php echo $categoria_faq['id_categoria_faq']; ?>" <?php echo ($data['id_categoria_faq'] == $categoria_faq['id_categoria_faq']) ? 'selected' : ''; ?>><?php echo $categoria_faq['categoria_faq']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>