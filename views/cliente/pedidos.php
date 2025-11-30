<div class="card panel-cliente-card">
    <div class="card-header">
        <h2>Mis Pedidos</h2>
    </div>

    <div class="card-body">
        <?php if (!empty($pedidos)): ?>
            <p>Aquí puedes ver el historial de tus pedidos.</p>
            
            <?php foreach ($pedidos as $pedido): ?>
                <div class="apartado-grupo my-4">

                    <div class="apartado-header p-3 rounded" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                        <div class="row align-items-center">
                            <div class="col-md-3"><strong>Pedido: #</strong><?php echo $pedido['id_pedido']; ?></div>
                            <div class="col-md-3"><strong>Fecha:</strong> <?php echo date("d/m/Y H:i", strtotime($pedido['fecha_pedido'])); ?></div>
                            <div class="col-md-3">
                                <strong>Estado:</strong>
                                <span class="badge <?php 
                                    if ($pedido['estado_pedido'] == 'Entregado') echo 'bg-success';
                                    elseif ($pedido['estado_pedido'] == 'Pendiente de Pago') echo 'bg-warning text-dark';
                                    elseif ($pedido['estado_pedido'] == 'Cancelado') echo 'bg-danger';
                                    else echo 'bg-info';
                                ?>">
                                    <?php echo $pedido['estado_pedido']; ?>
                                </span>
                            </div>
                            <div class="col-md-3 text-end"><strong>Total:</strong> $<?php echo number_format($pedido['total_pedido'], 2); ?></div>
                        </div>
                    </div>

                    <div class="apartado-detalles mt-3">
                        <?php if (!empty($pedido['detalles'])): ?>
                            <?php foreach ($pedido['detalles'] as $detalle): ?>
                                <div class="producto-carrito-resumen d-flex align-items-center mb-2 p-2">
                                    <img src="images/producto/<?php echo $detalle['imagen_producto']; ?>" alt="<?php echo $detalle['nombre_producto']; ?>" class="me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    <div class="flex-grow-1">
                                        <a href="producto_detalle.php?id=<?php echo $detalle['id_producto']; ?>" style="text-decoration: none; color: inherit; font-weight: 600;">
                                            <?php echo $detalle['nombre_producto']; ?>
                                        </a>
                                    </div>
                                    <div class="text-muted mx-3">Cantidad: <?php echo $detalle['cantidad']; ?></div>
                                    <div class="text-muted">$<?php echo number_format($detalle['precio_unitario'], 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="alert alert-secondary text-center" role="alert">
                Aún no tienes pedidos registrados.
            </div>
        <?php endif; ?>
    </div>
</div>