<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Asignación de Promociones a Productos</h1>
    <a href="promocion_producto.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Asignación</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Promoción</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Valor de Descuento</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Activo</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $promocion_producto): ?>
                        <tr>
                            <td><?php echo $promocion_producto['promocion']; ?></td>
                            <td><?php echo $promocion_producto['producto']; ?></td>
                            <td><?php echo $promocion_producto['valor_descuento']; ?></td>
                            <td><?php echo $promocion_producto['fecha_inicio']; ?></td>
                            <td><?php echo $promocion_producto['fecha_fin']; ?></td>
                            <td><?php echo $promocion_producto['activo'] ? 'Sí' : 'No'; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="promocion_producto.php?action=update&id_promocion=<?php echo $promocion_producto['id_promocion']; ?>&id_producto=<?php echo $promocion_producto['id_producto']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="promocion_producto.php?action=delete&id_promocion=<?php echo $promocion_producto['id_promocion']; ?>&id_producto=<?php echo $promocion_producto['id_producto']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

