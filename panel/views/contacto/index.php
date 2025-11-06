<h1>Contacto</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="contacto.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Asunto</th>
            <th scope="col">Mensaje</th>
            <th scope="col">Fecha de Envío</th>
            <th scope="col">Cliente</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $contacto): ?>
            <tr>
                <th scope="row"><?php echo $contacto['id_contacto']; ?></th>
                <td><?php echo $contacto['nombre']; ?></td>
                <td><?php echo $contacto['email']; ?></td>
                <td><?php echo $contacto['asunto']; ?></td>
                <td><?php echo $contacto['mensaje']; ?></td>
                <td><?php echo (new DateTime($contacto['fecha_envio']))->format('d/m/Y h:i A'); ?></td>
                <td><?php echo $contacto['cliente']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="contacto.php?action=update&id=<?php echo $contacto['id_contacto']; ?>" class="btn btn-warning">Editar</a>
                        <a href="contacto.php?action=delete&id=<?php echo $contacto['id_contacto']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>