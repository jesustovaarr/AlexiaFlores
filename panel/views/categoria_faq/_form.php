<h1>Nueva Categoría de FAQ</h1>
<form method="POST" action="categoria_faq.php?action=create">
  <div class="mb-3">
    <label for="categoria_faq" class="form-label">Nombre de la Categoría de FAQ</label>
    <input type="text" class="form-control" id="categoria_faq" name="categoria_faq" placeholder="Escribe aqui el nombre de la categoría de FAQ" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>