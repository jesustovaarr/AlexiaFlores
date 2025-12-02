<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Detalles de Apartado</h1>
    <a href="detalle_apartado.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Detalle</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID Detalle</th>
                        <th scope="col">ID Apartado</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $detalle): ?>
                        <tr>
                            <th scope="row"><?php echo $detalle['id_detalle_apartado']; ?></th>
                            <td><?php echo $detalle['id_apartado']; ?></td>
                            <td><?php echo $detalle['nombre_producto']; ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td>$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="detalle_apartado.php?action=update&id=<?php echo $detalle['id_detalle_apartado']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="detalle_apartado.php?action=delete&id=<?php echo $detalle['id_detalle_apartado']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


