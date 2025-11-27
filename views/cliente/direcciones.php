<div class="card panel-cliente-card">
    <div class="card-header">
        <h2>Mis Direcciones</h2>
    </div>
    <div class="card-body">
        <?php
        if ($do == 'create' || $do == 'update') {
            include_once('_form_direccion.php');
        } else {
            include_once('_lista_direcciones.php');
        }
        ?>
    </div>
</div>
