<h1>Editar Género</h1>
<form method = "POST" action = "genero.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="Genero" class="form-label">Nombre del Género</label>
    <input type="text" class="form-control" id="genero" name="genero" value = "<?php echo $data['genero']; ?>" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
