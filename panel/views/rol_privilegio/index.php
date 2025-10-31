<h1>Asignar Privilegios a Roles</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="rol_privilegio.php?action=create" class="btn btn-success">Nueva Asignación</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Rol</th>
            <th scope="col">Privilegio</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $asignacion) : ?>
            <tr>
                <td><?php echo $asignacion['rol']; ?></td>
                <td><?php echo $asignacion['privilegio']; ?></td>
                <td>
                    <a href="rol_privilegio.php?action=delete&id_rol=<?php echo $asignacion['id_rol']; ?>&id_privilegio=<?php echo $asignacion['id_privilegio']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>