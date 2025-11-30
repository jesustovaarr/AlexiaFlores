<h1>Gestión de Apartados</h1>

<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="apartado.php?action=create" class="btn btn-success">Nuevo Apartado</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID Apartado</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha Apartado</th>
            <th scope="col">Fecha Límite</th>
            <th scope="col">Total Apartado</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $apartado): ?>
            <tr>
                <td><?php echo $apartado['id_apartado']; ?></td>
                <td><?php echo $apartado['nombre_cliente'] . ' ' . $apartado['apellido_cliente']; ?></td>
                <td><?php echo date("d/m/Y H:i", strtotime($apartado['fecha_apartado'])); ?></td>
                <td><?php echo date("d/m/Y H:i", strtotime($apartado['fecha_limite'])); ?></td>
                <td>$<?php echo number_format($apartado['total_apartado'], 2); ?></td>
                <td><?php echo $apartado['estado_apartado']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="apartado.php?action=update&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-warning">Editar</a>
                        <a href="apartado.php?action=delete&id=<?php echo $apartado['id_apartado']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>