<main class="container my-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="cliente.php" class="list-group-item list-group-item-action active" aria-current="true">
                    Mi Perfil
                </a>
                <a href="#" class="list-group-item list-group-item-action">Mis Pedidos</a>
                <a href="#" class="list-group-item list-group-item-action">Mis Direcciones</a>
                <a href="panel/login.php?action=logout" class="list-group-item list-group-item-action text-danger">Cerrar Sesión</a>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h2>Bienvenido a tu cuenta, <?php echo $datos_cliente['nombre']; ?>!</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Información del Perfil</h5>
                    <div class="row">
                        
                        <div class="col-md-8">
                            <p><strong>Nombre Completo:</strong> <?php echo $datos_cliente['nombre'] . ' ' . $datos_cliente['primer_apellido'] . ' ' . $datos_cliente['segundo_apellido']; ?></p>
                            <p><strong>Correo Electrónico:</strong> <?php echo $_SESSION['correo']; ?></p>
                            <p><strong>Teléfono:</strong> <?php echo $datos_cliente['telefono']; ?></p>
                            <p><strong>Fecha de Nacimiento:</strong> <?php echo $datos_cliente['fecha_nacimiento']; ?></p>
                            <p><strong>Género:</strong> <?php echo $datos_cliente['genero']; ?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <?php if (!empty($datos_cliente['imagen_base64'])): ?>
                                <img src="<?php echo $datos_cliente['imagen_base64']; ?>" alt="Foto de Perfil" class="img-fluid rounded-circle" style="max-width: 150px;">
                            <?php else: ?>
                                <i class="fa-solid fa-user-circle" style="font-size: 100px;"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="editar_perfil.php" class="btn btn-tarjeta mt-3">Editar Perfil</a>
                </div>
            </div>

            </div>
        </div>
    </div>
</main>
