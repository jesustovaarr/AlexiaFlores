<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Géneros</h1>
    <a href="genero.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Género</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Género</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $genero): ?>
                        <tr>
                            <th scope="row"><?php echo $genero['id_genero']; ?></th>
                            <td><?php echo $genero['genero']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="genero.php?action=update&id=<?php echo $genero['id_genero']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="genero.php?action=delete&id=<?php echo $genero['id_genero']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


