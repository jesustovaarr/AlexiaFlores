<div class="card panel-cliente-card">
    <div class="card-header">
        <h2>Mis Pedidos</h2>
    </div>
    <div class="card-body">
        <?php if (!empty($pedidos)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID Pedido</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Método de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td>#<?php echo $pedido['id_pedido']; ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($pedido['fecha_pedido'])); ?></td>
                                <td>$<?php echo number_format($pedido['total_pedido'], 2); ?></td>
                                <td>
                                    <?php echo $pedido['estado_pedido']; ?>
                                </td>
                                <td><?php echo $pedido['metodo_pago']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-secondary" role="alert">
                Aún no tienes pedidos registrados.
            </div>
        <?php endif; ?>
    </div>
</div>
