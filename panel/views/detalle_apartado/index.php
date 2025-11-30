<h1>Gestión de Detalles de Apartados</h1>

<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="detalle_apartado.php?action=create" class="btn btn-success">Nuevo Detalle</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID Detalle</th>
            <th scope="col">ID Apartado</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $detalle): ?>
            <tr>
                <td><?php echo $detalle['id_detalle_apartado']; ?></td>
                <td><?php echo $detalle['id_apartado']; ?></td>
                <td><?php echo $detalle['nombre_producto']; ?></td>
                <td><?php echo $detalle['cantidad']; ?></td>
                <td>$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="detalle_apartado.php?action=update&id=<?php echo $detalle['id_detalle_apartado']; ?>" class="btn btn-warning">Editar</a>
                        <a href="detalle_apartado.php?action=delete&id=<?php echo $detalle['id_detalle_apartado']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>