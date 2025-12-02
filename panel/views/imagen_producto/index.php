<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Imágenes de Productos</h1>
    <a href="imagen_producto.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Imagen</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Orden</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $imagen_producto): ?>
                        <tr>
                            <th scope="row"><?php echo $imagen_producto['id_imagen']; ?></th>
                            <td><?php echo $imagen_producto['producto']; ?></td>
                            <td><img src="../images/producto/<?php echo $imagen_producto['imagen_producto']; ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" alt="Imagen de producto"/></td>
                            <td><?php echo $imagen_producto['orden']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="imagen_producto.php?action=update&id=<?php echo $imagen_producto['id_imagen']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="imagen_producto.php?action=delete&id=<?php echo $imagen_producto['id_imagen']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


