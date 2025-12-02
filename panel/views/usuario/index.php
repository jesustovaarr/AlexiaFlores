<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Usuarios</h1>
    <a href="usuario.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Usuario</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $usuario): ?>
                        <tr>
                            <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
                            <td><?php echo $usuario['correo']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="usuario.php?action=update&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Ver Roles y Privilegios">
                                            <i class="fas fa-user-shield"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="min-width: 250px;">
                                            <li><h6 class="dropdown-header">Roles</h6></li>
                                            <?php if (!empty($usuario['roles']) && is_array($usuario['roles'])): ?>
                                                <?php foreach ($usuario['roles'] as $rol): ?>
                                                    <li><span class="dropdown-item-text"><?php echo $rol; ?></span></li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><span class="dropdown-item-text text-muted small">No tiene roles</span></li>
                                            <?php endif; ?>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <li><h6 class="dropdown-header">Privilegios</h6></li>
                                            <?php if (!empty($usuario['permisos']) && is_array($usuario['permisos'])): ?>
                                                <?php foreach ($usuario['permisos'] as $permiso): ?>
                                                    <li><span class="dropdown-item-text"><?php echo $permiso; ?></span></li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><span class="dropdown-item-text text-muted small">No tiene privilegios</span></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <a href="usuario.php?action=delete&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


