<h1 class="page-title">Editar Pregunta Frecuente</h1>

<div class="card">
    <div class="card-header">
        Información de la Pregunta Frecuente
    </div>
    <div class="card-body">
        <form method="POST" action="faq.php?action=update&id=<?php echo $data['id_faq']; ?>">
            <div class="mb-3">
                <label for="pregunta" class="form-label">Pregunta</label>
                <input type="text" class="form-control" id="pregunta" name="pregunta" value="<?php echo $data['pregunta']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="respuesta" class="form-label">Respuesta</label>
                <textarea class="form-control" id="respuesta" name="respuesta" rows="3" required><?php echo $data['respuesta']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="id_categoria_faq" class="form-label">Categoría</label>
                <select class="form-select" name="id_categoria_faq" id="id_categoria_faq" required>
                    <?php foreach ($data_categoria_faq as $categoria_faq): ?>
                        <option value="<?php echo $categoria_faq['id_categoria_faq']; ?>" <?php echo ($data['id_categoria_faq'] == $categoria_faq['id_categoria_faq']) ? 'selected' : ''; ?>>
                            <?php echo $categoria_faq['categoria_faq']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="faq.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


