<h1 class="page-title">Editar Mensaje de Contacto</h1>

<div class="card">
    <div class="card-header">
        Información del Mensaje
    </div>
    <div class="card-body">
        <form method="POST" action="contacto.php?action=update&id=<?php echo $id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo $data['asunto']; ?>" placeholder="Asunto del mensaje">
            </div>

            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe aquí tu mensaje" required><?php echo $data['mensaje']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente Asociado (Opcional)</label>
                <select class="form-select" id="id_cliente" name="id_cliente">
                    <option value="">Seleccione un Cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($cliente['id_cliente'] == $data['id_cliente']) ? 'selected' : ''; ?>>
                            <?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="contacto.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


