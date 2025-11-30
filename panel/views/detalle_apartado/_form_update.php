<div>

    <div>
        <h2>Editar Detalle de Apartado #<?php echo $data['id_detalle_apartado']; ?></h2>
    </div>
    
    <div>
        <form action="detalle_apartado.php?action=update&id=<?php echo $data['id_detalle_apartado']; ?>" method="POST">
            
            <div class="mb-3">
                <label for="id_apartado" class="form-label">Apartado</label>
                <select class="form-select" id="id_apartado" name="id_apartado" required readonly>
                    <?php foreach ($data['apartados'] as $apartado_op): ?>
                        <option value="<?php echo $apartado_op['id_apartado']; ?>" <?php echo ($data['id_apartado'] == $apartado_op['id_apartado']) ? 'selected' : ''; ?>>
                            Apartado #<?php echo $apartado_op['id_apartado']; ?> - <?php echo $apartado_op['nombre_cliente'] . ' ' . $apartado_op['apellido_cliente']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto</label>
                <select class="form-select" id="id_producto" name="id_producto" required>
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($data['productos'] as $producto_op): ?>
                        <option value="<?php echo $producto_op['id_producto']; ?>" data-precio="<?php echo $producto_op['precio']; ?>" <?php echo ($data['id_producto'] == $producto_op['id_producto']) ? 'selected' : ''; ?>>
                            <?php echo $producto_op['producto']; ?> (Stock: <?php echo $producto_op['stock_disponible']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" value="<?php echo $data['precio_unitario']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['cantidad']; ?>" required min="1">
            </div>

            <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
            <a href="detalle_apartado.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('id_producto').addEventListener('change', function() {
        const precio = this.options[this.selectedIndex].getAttribute('data-precio');
        document.getElementById('precio_unitario').value = precio;
    });
</script>
