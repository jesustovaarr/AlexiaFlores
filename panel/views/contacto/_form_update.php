<h1>Editar Mensaje de Contacto</h1>
<form method="POST" action="contacto.php?action=update&id=<?php echo $id; ?>">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required="required">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required="required">
    </div>

    <div class="mb-3">
        <label for="asunto" class="form-label">Asunto</label>
        <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo $data['asunto']; ?>">
    </div>

    <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required="required"><?php echo $data['mensaje']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select class="form-control" id="id_cliente" name="id_cliente">
            <option value="">Selecciona un cliente (opcional)</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($cliente['id_cliente'] == $data['id_cliente']) ? 'selected' : ''; ?>><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
    </div>
</form>