<h1 class="page-title">Editar Categoría de FAQ</h1>

<div class="card">
    <div class="card-header">
        Información de la Categoría de FAQ
    </div>
    <div class="card-body">
        <form method="POST" action="categoria_faq.php?action=update&id=<?php echo $data['id_categoria_faq']; ?>">
            <div class="mb-3">
                <label for="categoria_faq" class="form-label">Nombre de la Categoría de FAQ</label>
                <input type="text" class="form-control" id="categoria_faq" name="categoria_faq" value="<?php echo $data['categoria_faq']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="categoria_faq.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>


