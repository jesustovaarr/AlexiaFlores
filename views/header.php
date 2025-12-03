<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arreglos Alexia Flores</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Trocchi&display=swap"
        rel="stylesheet">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/main.css?v=<?php echo filemtime('css/main.css'); ?>" />

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <header class="header-arrAlexiaFlores">

        <div id="barra-busqueda">
            <div class="container">
                <form action="buscar.php" method="GET" class="d-flex align-items-center">
                    <i class="fa-solid fa-magnifying-glass icono-barra-busqueda"></i>
                    <input type="search" name="q" class="form-control campo-texto-barra-busqueda" placeholder="Buscar productos..." aria-label="Buscar" autofocus>
                    <button type="button" id="btn-cerrar-barra-busqueda" aria-label="Cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="header-top border-bottom">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col text-start">
                        <a href="#" id="icono-barra-busqueda" class="header-icon" aria-label="Buscar">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>

                    <div class="col text-center">
                        <a class="header-logo" href="#">Arreglos Alexia Flores</a>
                    </div>

                    <div class="col text-end d-flex align-items-center justify-content-end">
                        <?php if ($sesion_iniciada && !$es_admin): ?>
                            <div class="dropdown d-inline-block">
                                <a href="#" class="header-icon d-flex align-items-center justify-content-center" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
                                    <?php if (!empty($datos_cliente['imagen_base64'])): ?>
                                        <img src="<?php echo $datos_cliente['imagen_base64']; ?>" alt="Foto de Perfil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fa-solid fa-user-circle" style="font-size: 30px;"></i>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="cliente.php">Mi Cuenta</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="panel/login.php?action=logout">Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        <?php elseif ($sesion_iniciada && $es_admin): ?>
                             <a href="panel/index.php" class="header-icon" aria-label="Admin Panel">
                                <i class="fa-solid fa-user-shield"></i>
                                <span class="ms-1 d-none d-lg-inline">Admin</span>
                            </a>
                        <?php else: ?>
                            <a href="panel/login.php" class="header-icon" aria-label="Login">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        <?php endif; ?>

                        <a href="carrito.php" class="header-icon ms-4" aria-label="Cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <nav class="header-nav">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="promociones.php">Promociones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </li>
            </ul>
        </nav>

    </header>


    <div class="header-anuncio">
        <p>Abierto Lunes a Sábado de 12:00 PM a 8:00 PM. Envíos solo en Rincón de Tamayo.</p>
    </div>

    <?php
    if (isset($_SESSION['alerta'])) {
        $alerta = $_SESSION['alerta'];
        echo '<div class="alerta-recortada">';
        include_once(__DIR__ . '/../panel/views/alert.php');
        echo '</div>';
        unset($_SESSION['alerta']);
    }
    ?>