<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Estados de Apartado</h1>
    <a href="estado_apartado.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Estado</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estado del Apartado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $estado_apartado): ?>
                        <tr>
                            <th scope="row"><?php echo $estado_apartado['id_estado_apartado']; ?></th>
                            <td><?php echo $estado_apartado['estado_apartado']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="estado_apartado.php?action=update&id=<?php echo $estado_apartado['id_estado_apartado']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="estado_apartado.php?action=delete&id=<?php echo $estado_apartado['id_estado_apartado']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


