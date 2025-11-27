<div class="card">
    <div class="card-header">
        <h2>Editar Perfil</h2>
    </div>

    <div class="card-body">
        <form action="cliente.php?action=perfil&do=update" method="POST" enctype="multipart/form-data" class="formulario-perfil">
            <div class="row mb-3 align-items-center">
                <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos_cliente['nombre']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="primer_apellido" class="col-sm-3 col-form-label">Primer Apellido</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo $datos_cliente['primer_apellido']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="segundo_apellido" class="col-sm-3 col-form-label">Segundo Apellido</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo $datos_cliente['segundo_apellido']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="telefono" class="col-sm-3 col-form-label">Teléfono</label>
                <div class="col-sm-9">
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $datos_cliente['telefono']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="fecha_nacimiento" class="col-sm-3 col-form-label">Fecha de Nacimiento</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $datos_cliente['fecha_nacimiento']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center texto-ayuda">
                <label for="foto_perfil" class="col-sm-3 col-form-label">Cambiar Foto</label>
                <div class="col-sm-9">
                    <input class="form-control" type="file" id="foto_perfil" name="foto_perfil">
                    <small class="form-text text-muted">Sube una nueva imagen para reemplazar la actual.</small>
                </div>
            </div>

            <hr class="my-4">
            
            <h5 class="card-title mb-3">Cambiar Contraseña</h5>
            <div class="row mb-3 align-items-center texto-ayuda">
                <label for="contrasena_actual" class="col-sm-3 col-form-label">Contraseña Actual</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="contrasena_actual" name="contrasena_actual">
                    <small class="form-text text-muted">Deja en blanco si no quieres cambiar tu contraseña.</small>
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label for="contrasena_nueva" class="col-sm-3 col-form-label">Nueva Contraseña</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="contrasena_nueva" name="contrasena_nueva">
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label for="contrasena_confirmar" class="col-sm-3 col-form-label">Confirmar Contraseña</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="contrasena_confirmar" name="contrasena_confirmar">
                </div>
            </div>

            <button type="submit" class="btn btn-tarjeta">Guardar Cambios</button>
            <a href="cliente.php?action=perfil" class="btn btn-tarjeta-sec">Cancelar</a>
        </form>
    </div>
</div>