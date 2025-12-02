<h1 class="page-title">Editar Método de Pago</h1>

<div class="card">
    <div class="card-header">
        Información del Método de Pago
    </div>
    <div class="card-body">
        <form method="POST" action="metodo_pago.php?action=update&id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="metodo_pago" class="form-label">Nombre del Método de Pago</label>
                <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" value="<?php echo $data['metodo_pago']; ?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Cambios</button>
                <a href="metodo_pago.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



