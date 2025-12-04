<h1 class="page-title">Nuevo Detalle de Pedido</h1>

<div class="card">
    <div class="card-header">
        Información del Detalle del Pedido
    </div>
    <div class="card-body">
        <form method="POST" action="detalle_pedido.php?action=create">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_pedido" class="form-label">Pedido</label>
                        <select name="id_pedido" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Pedido</option>
                            <?php foreach ($data['pedidos'] as $pedido): ?>
                                <option value="<?php echo $pedido['id_pedido']; ?>"><?php echo $pedido['id_pedido'] . ' - Cliente: ' . $pedido['nombre_cliente']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select name="id_producto" class="form-select" required>
                            <option value="" selected disabled>Seleccione un Producto</option>
                            <?php foreach ($data['productos'] as $producto): ?>
                                <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['producto']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Escribe aquí la cantidad" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Detalle</button>
                <a href="detalle_pedido.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


