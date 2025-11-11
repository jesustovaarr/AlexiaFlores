<h1>Nuevo Mensaje de Contacto</h1>
<form method="POST" action="contacto.php?action=create">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aqui el nombre" required="required">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Escribe aqui el email" required="required">
    </div>

    <div class="mb-3">
        <label for="asunto" class="form-label">Asunto</label>
        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Escribe aqui el asunto">
    </div>

    <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="3"  placeholder="Escribe aqui el mensaje" required="required"></textarea>
    </div>

    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select class="form-control" id="id_cliente" name="id_cliente">
            <option value="" selected disabled>Seleccione un Cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
    </div>
</form>