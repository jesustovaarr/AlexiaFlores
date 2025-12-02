<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Administrar Productos</h1>
    <a href="producto.php?action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Producto</a>
</div>

<form method="POST" action="reportes.php?action=PDFProductos" target="_blank"> <!-- Form wrapping the card -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select_all_products">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Destacado</th>
                            <th scope="col" class="text-center">QR</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $producto): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="IDsProductos[]" value="<?php echo $producto['id_producto']; ?>">
                                </td>
                                <th scope="row"><?php echo $producto['id_producto']; ?></th>
                                <td><?php echo $producto['producto']; ?></td>
                                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                <td><?php echo $producto['stock_disponible']; ?></td>
                                <td><?php echo $producto['categoria']; ?></td>
                                <td><?php echo $producto['destacado'] ?? 'N/A'; ?></td>
                                <td class="text-center">
                                    <img src="reportes.php?action=QRProductos&id=<?php echo $producto['id_producto']; ?>" alt="QR Producto" style="width: 50px; height: 50px;">
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="producto.php?action=update&id=<?php echo $producto['id_producto']; ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="producto.php?action=delete&id=<?php echo $producto['id_producto']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end"> <!-- New card-footer for the button -->
            <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir Productos Seleccionados</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select_all_products');
        const productCheckboxes = document.querySelectorAll('input[name="IDsProductos[]"]');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
    });
</script>


