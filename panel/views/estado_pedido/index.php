<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Estados de Pedido</h1>
    <a href="estado_pedido.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Estado</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estado del Pedido</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $estado_pedido): ?>
                        <tr>
                            <th scope="row"><?php echo $estado_pedido['id_estado_pedido']; ?></th>
                            <td><?php echo $estado_pedido['estado_pedido']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="estado_pedido.php?action=update&id=<?php echo $estado_pedido['id_estado_pedido']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="estado_pedido.php?action=delete&id=<?php echo $estado_pedido['id_estado_pedido']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


