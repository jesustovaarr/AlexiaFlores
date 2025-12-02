<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Categorías de FAQ</h1>
    <a href="categoria_faq.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Categoría</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoría de FAQ</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $categoria_faq): ?>
                        <tr>
                            <th scope="row"><?php echo $categoria_faq['id_categoria_faq']; ?></th>
                            <td><?php echo $categoria_faq['categoria_faq']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="categoria_faq.php?action=update&id=<?php echo $categoria_faq['id_categoria_faq']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="categoria_faq.php?action=delete&id=<?php echo $categoria_faq['id_categoria_faq']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


