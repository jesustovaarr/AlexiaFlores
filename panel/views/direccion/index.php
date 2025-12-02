<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Direcciones</h1>
    <a href="direccion.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Dirección</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Dirección Completa</th>
                        <th scope="col">Principal</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $direccion): ?>
                        <tr>
                            <th scope="row"><?php echo $direccion['id_direccion']; ?></th>
                            <td><?php echo $direccion['nombre'] . ' ' . $direccion['primer_apellido']; ?></td>
                            <td><?php echo $direccion['calle'] . ' ' . $direccion['numero'] . ', ' . $direccion['colonia'] . ', ' . $direccion['ciudad'] . ', ' . $direccion['estado'] . ' C.P. ' . $direccion['codigo_postal']; ?></td>
                            <td><?php echo ($direccion['es_principal']) ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="direccion.php?action=update&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="direccion.php?action=delete&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


