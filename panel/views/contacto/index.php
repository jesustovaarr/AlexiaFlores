<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Mensajes de Contacto</h1>
    <a href="contacto.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Mensaje</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Fecha de Envío</th>
                        <th scope="col">Cliente</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $contacto): ?>
                        <tr>
                            <th scope="row"><?php echo $contacto['id_contacto']; ?></th>
                            <td><?php echo $contacto['nombre']; ?></td>
                            <td><?php echo $contacto['email']; ?></td>
                            <td><?php echo $contacto['asunto']; ?></td>
                            <td><?php echo substr($contacto['mensaje'], 0, 50) . (strlen($contacto['mensaje']) > 50 ? '...' : ''); ?></td>
                            <td><?php echo (new DateTime($contacto['fecha_envio']))->format('d/m/Y H:i'); ?></td>
                            <td><?php echo $contacto['cliente'] ?? 'N/A'; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="contacto.php?action=update&id=<?php echo $contacto['id_contacto']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="contacto.php?action=delete&id=<?php echo $contacto['id_contacto']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


