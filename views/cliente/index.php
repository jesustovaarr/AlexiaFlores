<main class="container my-5">
    <div class="row">
                <div class="col-lg-3">
                    <div class="list-group">
                        <a href="cliente.php?action=perfil" class="list-group-item list-group-item-action <?php echo ($action == 'perfil') ? 'active' : ''; ?>">
                            Mi Perfil
                        </a>
                        <a href="cliente.php?action=pedidos" class="list-group-item list-group-item-action <?php echo ($action == 'pedidos') ? 'active' : ''; ?>">
                            Mis Pedidos
                        </a>
                        <a href="cliente.php?action=apartados" class="list-group-item list-group-item-action <?php echo ($action == 'apartados') ? 'active' : ''; ?>">
                            Mis Apartados
                        </a>
                        <a href="cliente.php?action=direcciones" class="list-group-item list-group-item-action <?php echo ($action == 'direcciones') ? 'active' : ''; ?>">
                            Mis Direcciones
                        </a>
                        <a href="panel/login.php?action=logout" class="list-group-item list-group-item-action text-danger">Cerrar Sesión</a>
                    </div>
                </div>
                <div class="col-lg-9">
                    
                    <?php if ($action == 'perfil'): 
                        if ($do == 'edit') {
                            $datos_cliente = $cliente;
                            require_once(__DIR__ . '/_form_perfil.php');
                        } else {?>
        
                        <div class="card">
                            <div class="card-header">
                                <h2>Bienvenido a tu cuenta, <?php echo $cliente['nombre']; ?>!</h2>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Información del Perfil</h5>
                                <div class="row">
                                    
                                    <div class="col-md-8">
                                        <p><strong>Nombre Completo:</strong> <?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido']; ?></p>
                                        <p><strong>Correo Electrónico:</strong> <?php echo $_SESSION['correo']; ?></p>
                                        <p><strong>Teléfono:</strong> <?php echo $cliente['telefono']; ?></p>
                                        <p><strong>Fecha de Nacimiento:</strong> <?php echo $cliente['fecha_nacimiento']; ?></p>
                                        <p><strong>Género:</strong> <?php echo $cliente['genero']; ?></p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <?php if (!empty($cliente['imagen_base64'])): ?>
                                            <img src="<?php echo $cliente['imagen_base64']; ?>" alt="Foto de Perfil" class="img-fluid rounded-circle" style="max-width: 150px;">
                                        <?php else: ?>
                                            <i class="fa-solid fa-user-circle" style="font-size: 100px;"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <a href="cliente.php?action=perfil&do=edit" class="btn btn-tarjeta mt-3">Editar Perfil</a>
                            </div>
                        </div>
                    <?php 
                        }
                    elseif ($action == 'pedidos'): 
                        $pedidos = $data;
                        require_once(__DIR__ . '/pedidos.php');
                    elseif ($action == 'apartados'):
                        $apartados = $data;
                        require_once(__DIR__ . '/_lista_apartados.php');
                    elseif ($action == 'direcciones'): 
                        require_once(__DIR__ . '/direcciones.php'); 
                    endif; ?>
        </div>
    </div>
</main>