<h1>Editar Rol</h1>
<form method = "POST" action = "rol.php?action=update&id=<?php echo $id; ?>">
  <div class="mb-3">
    <label for="Rol" class="form-label">Nombre del Rol</label>
    <input type="text" class="form-control" id="rol" name="rol" value = "<?php echo $data['rol']; ?>" placeholder="Escribe aqui el nombre" required = "required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>
