<h1>Editar Privilegio</h1>
<form method="POST" action="privilegio.php?action=update&id=<?php echo $data['id_privilegio']; ?>">
  <div class="mb-3">
    <label for="privilegio" class="form-label">Nombre del Privilegio</label>
    <input type="text" class="form-control" id="privilegio" name="privilegio" value="<?php echo $data['privilegio']; ?>" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>