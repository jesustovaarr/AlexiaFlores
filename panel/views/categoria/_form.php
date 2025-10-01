<h1>Nueva Categoría</h1>
<form method = "POST" action = "categoria.php?action=create">
  <div class="mb-3">
    <label for="Categoria" class="form-label">Nombre de la Categoría</label>
    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <label for="Descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe aqui la descripcion">
  </div>  

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
