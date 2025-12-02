<h1 class="page-title">Nuevo Estado de Apartado</h1>

<div class="card">
    <div class="card-header">
        Información del Estado de Apartado
    </div>
    <div class="card-body">
        <form method="POST" action="estado_apartado.php?action=create">
            <div class="mb-3">
                <label for="estado_apartado" class="form-label">Nombre del Estado del Apartado</label>
                <input type="text" class="form-control" id="estado_apartado" name="estado_apartado" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Estado</button>
                <a href="estado_apartado.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



