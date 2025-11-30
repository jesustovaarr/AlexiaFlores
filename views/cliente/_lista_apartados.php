<div class="card panel-cliente-card">
    <div class="card-header">
        <h2>Mis Apartados</h2>
    </div>

    <div class="card-body">
        <?php if (!empty($apartados)): ?>
            <p>Estos son los productos que has apartado. Recuerda pasar a la tienda a pagar y recogerlos antes de la fecha límite.</p>
            
            <?php foreach ($apartados as $apartado): ?>
                <div class="apartado-grupo my-4">
                    <div class="apartado-header p-3 rounded" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                        <div class="row align-items-center">
                            <div class="col-md-3"><strong>Apartado: #</strong> <?php echo $apartado['id_apartado']; ?></div>
                            <div class="col-md-3"><strong>Fecha Límite:</strong> <?php echo date("d/m/Y H:i", strtotime($apartado['fecha_limite'])); ?></div>
                            <div class="col-md-3">
                                <strong>Estado:</strong>
                                <span class="badge <?php 
                                    if ($apartado['estado_apartado'] == 'Pagado y Apartado') echo 'bg-success';
                                    elseif ($apartado['estado_apartado'] == 'Apartado y Pendiente de Pago') echo 'bg-warning text-dark';
                                    elseif ($apartado['estado_apartado'] == 'Cancelado') echo 'bg-danger';
                                    else echo 'bg-info';
                                ?>">
                                    <?php echo htmlspecialchars($apartado['estado_apartado']); ?>
                                </span>
                            </div>
                            <div class="col-md-3 text-end"><strong>Total:</strong> $<?php echo number_format($apartado['total_apartado'], 2); ?></div>
                        </div>
                    </div>

                    <div class="apartado-detalles mt-3">
                        <?php if (!empty($apartado['detalles'])): ?>
                            <?php foreach ($apartado['detalles'] as $detalle): ?>
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
                Aún no tienes productos apartados.
            </div>
        <?php endif; ?>
    </div>
</div>