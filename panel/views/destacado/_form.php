<h1 class="page-title">Nuevo Destacado</h1>

<div class="card">
    <div class="card-header">
        Información del Destacado
    </div>
    <div class="card-body">
        <form method="POST" action="destacado.php?action=create">
            <div class="mb-3">
                <label for="destacado" class="form-label">Nombre del Destacado</label>
                <input type="text" class="form-control" id="destacado" name="destacado" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin">
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Destacado</button>
                <a href="destacado.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



