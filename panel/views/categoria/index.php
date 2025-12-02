<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Categorías</h1>
    <a href="categoria.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Categoría</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $categoria): ?>
                        <tr>
                            <th scope="row"><?php echo $categoria['id_categoria']; ?></th>
                            <td><?php echo $categoria['categoria']; ?></td>
                            <td><?php echo $categoria['descripcion']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="categoria.php?action=update&id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="categoria.php?action=delete&id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


