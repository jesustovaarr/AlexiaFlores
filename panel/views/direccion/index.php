<h1>Direcciones</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="direccion.php?action=create" class="btn btn-success">Nueva Dirección</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Dirección</th>
            <th scope="col">¿Es Principal?</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $direccion): ?>
            <tr>
                <th scope="row"><?php echo $direccion['id_direccion']; ?></th>
                <td><?php echo $direccion['nombre'] . ' ' . $direccion['primer_apellido']; ?></td>
                <td><?php echo $direccion['calle'] . ' ' . $direccion['numero'] . ', ' . $direccion['colonia'] . ', ' . $direccion['ciudad'] . ', ' . $direccion['estado'] . ' C.P. ' . $direccion['codigo_postal']; ?></td>
                <td><?php echo ($direccion['es_principal']) ? 'Sí' : 'No'; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="direccion.php?action=update&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-warning">Editar</a>
                        <a href="direccion.php?action=delete&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>