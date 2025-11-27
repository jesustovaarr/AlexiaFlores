<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Dirección</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Estado</th>
                <th scope="col">C.P.</th>
                <th scope="col">Principal</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $direccion): ?>
                    <tr>
                        <td><?php echo $direccion['calle'] . ' ' . $direccion['numero'] . ', ' . $direccion['colonia']; ?></td>
                        <td><?php echo $direccion['ciudad']; ?></td>
                        <td><?php echo $direccion['estado']; ?></td>
                        <td><?php echo $direccion['codigo_postal']; ?></td>
                        <td>
                            <?php if ($direccion['es_principal']): ?>
                                <span class="distintivo-direccion-principal">Sí</span>
                            <?php else: ?>
                                <a href="cliente.php?action=direcciones&do=principal&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-sm btn-secondary btn-accion">Hacer Principal</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="cliente.php?action=direcciones&do=update&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-sm btn-warning btn-accion">Editar</a>
                            <?php if (!$direccion['es_principal']): ?>
                                <a href="cliente.php?action=direcciones&do=delete&id=<?php echo $direccion['id_direccion']; ?>" class="btn btn-sm btn-danger btn-accion" onclick="return confirm('¿Estás seguro de que quieres eliminar esta dirección?');">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No tienes direcciones registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a href="cliente.php?action=direcciones&do=create" class="btn btn-tarjeta mt-3">Agregar Nueva Dirección</a>
