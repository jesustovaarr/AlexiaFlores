<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Preguntas Frecuentes</h1>
    <a href="faq.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Pregunta</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Respuesta</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $faq): ?>
                        <tr>
                            <th scope="row"><?php echo $faq['id_faq']; ?></th>
                            <td><?php echo $faq['pregunta']; ?></td>
                            <td><?php echo substr($faq['respuesta'], 0, 100) . (strlen($faq['respuesta']) > 100 ? '...' : ''); ?></td>
                            <td><?php echo $faq['categoria_faq']; ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="faq.php?action=update&id=<?php echo $faq['id_faq']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="faq.php?action=delete&id=<?php echo $faq['id_faq']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


