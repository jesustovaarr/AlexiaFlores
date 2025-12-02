<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Pedidos</h1>
    <a href="pedido.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Pedido</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha del Pedido</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Método de Pago</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $pedido): ?>
                        <tr>
                            <th scope="row"><?php echo $pedido['id_pedido']; ?></th>
                            <td><?php echo $pedido['nombre_cliente'] . ' ' . $pedido['primer_apellido']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></td>
                            <td>$<?php echo number_format($pedido['total_pedido'], 2); ?></td>
                            <td><?php echo $pedido['estado_pedido']; ?></td>
                            <td><?php echo $pedido['metodo_pago']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="pedido.php?action=update&id=<?php echo $pedido['id_pedido']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="pedido.php?action=delete&id=<?php echo $pedido['id_pedido']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


