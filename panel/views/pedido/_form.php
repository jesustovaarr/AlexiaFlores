<h1 class="page-title">Nuevo Pedido</h1>

<div class="card">
    <div class="card-header">
        Información del Pedido
    </div>
    <div class="card-body">
        <form method="POST" action="pedido.php?action=create">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select name="id_cliente" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Cliente</option>
                            <?php foreach ($data_cliente as $cliente): ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_pedido" class="form-label">Fecha del Pedido</label>
                        <input type="datetime-local" class="form-control" id="fecha_pedido" name="fecha_pedido" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_estado_pedido" class="form-label">Estado del Pedido</label>
                        <select name="id_estado_pedido" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Estado</option>
                            <?php foreach ($data_estado_pedido as $estado_pedido): ?>
                                <option value="<?php echo $estado_pedido['id_estado_pedido']; ?>"><?php echo $estado_pedido['estado_pedido']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="id_metodo_pago" class="form-label">Método de Pago</label>
                <select name="id_metodo_pago" class="form-select" required>
                    <option value="" selected disabled>Seleccione un Método</option>
                    <?php foreach ($data_metodo_pago as $metodo_pago): ?>
                        <option value="<?php echo $metodo_pago['id_metodo_pago']; ?>"><?php echo $metodo_pago['metodo_pago']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Pedido</button>
                <a href="pedido.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


