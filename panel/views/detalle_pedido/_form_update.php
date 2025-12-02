<h1 class="page-title">Editar Detalle de Pedido</h1>

<div class="card">
    <div class="card-header">
        Modificar Detalle del Pedido
    </div>
    <div class="card-body">
        <form method="POST" action="detalle_pedido.php?action=update&id_pedido=<?php echo $data['id_pedido']; ?>&id_producto=<?php echo $data['id_producto']; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_pedido" class="form-label">ID Pedido</label>
                        <input type="text" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $data['id_pedido']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">ID Producto</label>
                        <input type="text" class="form-control" id="id_producto" name="id_producto" value="<?php echo $data['id_producto']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['cantidad']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" value="<?php echo $data['precio_unitario']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="detalle_pedido.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


