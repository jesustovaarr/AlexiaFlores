<h1>Editar Asignación de Rol</h1>
<form method="POST" action="usuario_rol.php?action=update&id_usuario=<?php echo $data['id_usuario']; ?>&id_rol=<?php echo $data['id_rol']; ?>">

  <div class="mb-3">
    <label for="id_usuario" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $data['correo']; ?>" disabled>
  </div>

  <div class="mb-3">
    <label for="id_rol" class="form-label">Rol</label>
    <select name="id_rol_nuevo" class="form-control">
      <?php foreach ($data_rol as $rol): ?>
        <option value="<?php echo $rol['id_rol']; ?>" <?php echo ($rol['id_rol'] == $data['id_rol']) ? 'selected' : ''; ?>><?php echo $rol['rol']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>

</form>