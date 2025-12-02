<h1 class="page-title">Nuevo Estado de Pedido</h1>

<div class="card">
    <div class="card-header">
        Información del Estado de Pedido
    </div>
    <div class="card-body">
        <form method="POST" action="estado_pedido.php?action=create">
            <div class="mb-3">
                <label for="estado_pedido" class="form-label">Nombre del Estado del Pedido</label>
                <input type="text" class="form-control" id="estado_pedido" name="estado_pedido" required>
            </div>
            <div class="mt-4">
                <button type="submit" name="enviar" class="btn btn-primary">Guardar Estado</button>
                <a href="estado_pedido.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



