<h1>Nuevo Privilegio</h1>
<form method="POST" action="privilegio.php?action=create">
  <div class="mb-3">
    <label for="privilegio" class="form-label">Nombre del Privilegio</label>
    <input type="text" class="form-control" id="privilegio" name="privilegio" placeholder="Escribe aqui el nombre del privilegio" required="required">
  </div>

  <div class="mb-3">
    <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
  </div>
</form>