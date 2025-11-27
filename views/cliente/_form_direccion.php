<?php
$isUpdate = ($do == 'update');
$formAction = $isUpdate ? 'cliente.php?action=direcciones&do=update&id=' . $data['id_direccion'] : 'cliente.php?action=direcciones&do=create';
?>

<h4 class="mb-4"><?php echo $isUpdate ? 'Editar Dirección' : 'Agregar Nueva Dirección'; ?></h4>

<form action="<?php echo $formAction; ?>" method="POST" class="formulario-perfil">
    
    <div class="row mb-3 align-items-center">
        <label for="calle" class="col-sm-3 col-form-label">Calle</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $isUpdate ? $data['calle'] : ''; ?>" required>
        </div>
    </div>
    
    <div class="row mb-3 align-items-center">
        <label for="numero" class="col-sm-3 col-form-label">Número</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $isUpdate ? $data['numero'] : ''; ?>" required>
        </div>
    </div>
    
    <div class="row mb-3 align-items-center">
        <label for="colonia" class="col-sm-3 col-form-label">Colonia</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="colonia" name="colonia" value="<?php echo $isUpdate ? $data['colonia'] : ''; ?>" required>
        </div>
    </div>
    
    <div class="row mb-3 align-items-center">
        <label for="ciudad" class="col-sm-3 col-form-label">Ciudad</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $isUpdate ? $data['ciudad'] : ''; ?>" required>
        </div>
    </div>

    <div class="row mb-3 align-items-center">
        <label for="estado" class="col-sm-3 col-form-label">Estado</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $isUpdate ? $data['estado'] : ''; ?>" required>
        </div>
    </div>

    <div class="row mb-3 align-items-center">
        <label for="codigo_postal" class="col-sm-3 col-form-label">Código Postal</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?php echo $isUpdate ? $data['codigo_postal'] : ''; ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-9 offset-sm-3">
                    <div class="mb-3 form-check">
                        <input type="checkbox" id="es_principal" name="es_principal" value="1" <?php echo ($isUpdate && $data['es_principal']) ? 'checked' : ''; ?>>
                        <label for="es_principal">Marcar como dirección principal</label>
                    </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-sm-9 offset-sm-3">
            <button type="submit" name="enviar" class="btn btn-tarjeta"><?php echo $isUpdate ? 'Actualizar Dirección' : 'Guardar Dirección'; ?></button>
            <a href="cliente.php?action=direcciones" class="btn btn-tarjeta-sec">Cancelar</a>
        </div>
    </div>
</form>

