<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Asignar Privilegios a Roles</h1>
    <a href="rol_privilegio.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Asignación</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Rol</th>
                        <th scope="col">Privilegio Asignado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $asignacion): ?>
                        <tr>
                            <td><?php echo $asignacion['rol']; ?></td>
                            <td><?php echo $asignacion['privilegio']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="rol_privilegio.php?action=update&id_rol=<?php echo $asignacion['id_rol']; ?>&id_privilegio=<?php echo $asignacion['id_privilegio']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="rol_privilegio.php?action=delete&id_rol=<?php echo $asignacion['id_rol']; ?>&id_privilegio=<?php echo $asignacion['id_privilegio']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


