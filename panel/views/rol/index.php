<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Roles</h1>
    <a href="rol.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Rol</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $rol): ?>
                        <tr>
                            <th scope="row"><?php echo $rol['id_rol']; ?></th>
                            <td><?php echo $rol['rol']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="rol.php?action=update&id=<?php echo $rol['id_rol']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="rol.php?action=delete&id=<?php echo $rol['id_rol']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


