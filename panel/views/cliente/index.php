<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Clientes</h1>
    <a href="cliente.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Cliente</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Género</th>
                        <th scope="col">Fec. Nacimiento</th>
                        <th scope="col">Fec. Registro</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $cliente): ?>
                        <tr>
                            <th scope="row"><?php echo $cliente['id_cliente']; ?></th>
                            <td><img src="<?php echo $cliente['imagen_base64']; ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" alt="Foto de cliente"/></td>
                            <td><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido']; ?></td>
                            <td><?php echo $cliente['telefono']; ?></td>
                            <td><?php echo $cliente['correo']; ?></td>
                            <td><?php echo $cliente['genero']; ?></td>
                            <td><?php echo $cliente['fecha_nacimiento']; ?></td>
                            <td><?php echo (new DateTime($cliente['fecha_registro']))->format('d/m/Y H:i'); ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="cliente.php?action=update&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="cliente.php?action=delete&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



