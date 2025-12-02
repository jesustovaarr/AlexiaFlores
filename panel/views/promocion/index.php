<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Promociones</h1>
    <a href="promocion.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Promoción</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Promoción</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Tipo Descuento</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $promocion): ?>
                        <tr>
                            <th scope="row"><?php echo $promocion['id_promocion']; ?></th>
                            <td><?php echo $promocion['promocion']; ?></td>
                            <td><?php echo $promocion['descripcion']; ?></td>
                            <td><img src="../images/promocion/<?php echo $promocion['imagen_banner']; ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" alt="Banner de Promoción"/></td>
                            <td><?php echo $promocion['tipo_descuento']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="promocion.php?action=update&id=<?php echo $promocion['id_promocion']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="promocion.php?action=delete&id=<?php echo $promocion['id_promocion']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


