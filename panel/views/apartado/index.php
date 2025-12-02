<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Gestión de Apartados</h1>
    <a href="apartado.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Apartado</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha Apartado</th>
                        <th scope="col">Fecha Límite</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $apartado): ?>
                        <tr>
                            <th scope="row"><?php echo $apartado['id_apartado']; ?></th>
                            <td><?php echo $apartado['nombre_cliente'] . ' ' . $apartado['apellido_cliente']; ?></td>
                            <td><?php echo $apartado['producto_nombre']; ?></td>
                            <td><?php echo $apartado['cantidad']; ?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($apartado['fecha_apartado'])); ?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($apartado['fecha_limite'])); ?></td>
                            <td>$<?php echo number_format($apartado['total_apartado'], 2); ?></td>
                            <td><?php echo $apartado['estado_apartado']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="apartado.php?action=update&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="apartado.php?action=delete&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

