<h1>Editar Categoría de FAQ</h1>
<form method="POST" action="categoria_faq.php?action=update&id=<?php echo $data['id_categoria_faq']; ?>">
  <div class="mb-3">
    <label for="categoria_faq" class="form-label">Nombre de la Categoría de FAQ</label>
    <input type="text" class="form-control" id="categoria_faq" name="categoria_faq" value="<?php echo $data['categoria_faq']; ?>" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>