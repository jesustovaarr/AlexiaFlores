<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Asignar Roles a Usuarios</h1>
    <a href="usuario_rol.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Asignación</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Usuario (Correo)</th>
                        <th scope="col">Rol Asignado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $asignacion): ?>
                        <tr>
                            <td><?php echo $asignacion['correo']; ?></td>
                            <td><?php echo $asignacion['rol']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="usuario_rol.php?action=update&id_usuario=<?php echo $asignacion['id_usuario']; ?>&id_rol=<?php echo $asignacion['id_rol']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="usuario_rol.php?action=delete&id_usuario=<?php echo $asignacion['id_usuario']; ?>&id_rol=<?php echo $asignacion['id_rol']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



