<h1>Asignar Roles a Usuarios</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="usuario_rol.php?action=create" class="btn btn-success">Nueva Asignación</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Usuario (Correo)</th>
            <th scope="col">Rol</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $asignacion) : ?>
            <tr>
                <td><?php echo $asignacion['correo']; ?></td>
                <td><?php echo $asignacion['rol']; ?></td>
                <td>
                    <a href="usuario_rol.php?action=delete&id_usuario=<?php echo $asignacion['id_usuario']; ?>&id_rol=<?php echo $asignacion['id_rol']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

