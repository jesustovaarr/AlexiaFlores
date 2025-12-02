<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Destacados</h1>
    <a href="destacado.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Destacado</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Destacado</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $destacado): ?>
                        <tr>
                            <th scope="row"><?php echo $destacado['id_destacado']; ?></th>
                            <td><?php echo $destacado['destacado']; ?></td>
                            <td><?php echo $destacado['descripcion']; ?></td>
                            <td><?php echo $destacado['fecha_inicio']; ?></td>
                            <td><?php echo $destacado['fecha_fin']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="destacado.php?action=update&id=<?php echo $destacado['id_destacado']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="destacado.php?action=delete&id=<?php echo $destacado['id_destacado']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


