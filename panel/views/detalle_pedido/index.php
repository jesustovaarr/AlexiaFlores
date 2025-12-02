<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Detalles de Pedido</h1>
    <a href="detalle_pedido.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Detalle</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID Pedido</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $detalle_pedido): ?>
                        <tr>
                            <th scope="row"><?php echo $detalle_pedido['id_pedido']; ?></th>
                            <td><?php echo $detalle_pedido['nombre_producto']; ?></td>
                            <td><?php echo $detalle_pedido['cantidad']; ?></td>
                            <td>$<?php echo number_format($detalle_pedido['precio_unitario'], 2); ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="detalle_pedido.php?action=update&id_pedido=<?php echo $detalle_pedido['id_pedido']; ?>&id_producto=<?php echo $detalle_pedido['id_producto']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="detalle_pedido.php?action=delete&id_pedido=<?php echo $detalle_pedido['id_pedido']; ?>&id_producto=<?php echo $detalle_pedido['id_producto']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


