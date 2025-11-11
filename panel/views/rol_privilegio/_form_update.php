<h1>Editar Asignación de Privilegio</h1>
<form method="POST" action="rol_privilegio.php?action=update&id_rol=<?php echo $data['id_rol']; ?>&id_privilegio=<?php echo $data['id_privilegio']; ?>">

  <div class="mb-3">
    <label for="id_rol" class="form-label">Rol</label>
    <input type="text" class="form-control" id="id_rol" name="id_rol" value="<?php echo $data['rol']; ?>" disabled>
  </div>

  <div class="mb-3">
    <label for="id_privilegio" class="form-label">Privilegio</label>
    <select name="id_privilegio_nuevo" class="form-control">
      <?php foreach ($data_privilegio as $privilegio): ?>
        <option value="<?php echo $privilegio['id_privilegio']; ?>" <?php echo ($privilegio['id_privilegio'] == $data['id_privilegio']) ? 'selected' : ''; ?>><?php echo $privilegio['privilegio']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>