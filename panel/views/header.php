<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Arreglos Alexia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Arreglos Alexia</h3>
            <strong>AAF</strong>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <!-- Módulo de Ventas -->
            <li>
                <a href="#ventasSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-shopping-cart"></i>
                    Ventas
                </a>
                <ul class="collapse list-unstyled" id="ventasSubmenu">
                    <li><a href="pedido.php">Pedidos</a></li>
                    <li><a href="detalle_pedido.php">Detalles de Pedido</a></li>
                    <li><a href="apartado.php">Apartados</a></li>
                    <li><a href="detalle_apartado.php">Detalles de Apartado</a></li>
                    <li><a href="cliente.php">Clientes</a></li>
                    <li><a href="direccion.php">Direcciones</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="estado_pedido.php">Estados de Pedido</a></li>
                    <li><a href="estado_apartado.php">Estados de Apartado</a></li>
                </ul>
            </li>
            <!-- Módulo de Catálogo -->
            <li>
                <a href="#catalogoSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-book"></i>
                    Catálogo
                </a>
                <ul class="collapse list-unstyled" id="catalogoSubmenu">
                    <li><a href="producto.php">Productos</a></li>
                    <li><a href="categoria.php">Categorías</a></li>
                    <li><a href="imagen_producto.php">Imágenes de Productos</a></li>
                    <li><a href="genero.php">Géneros</a></li>
                </ul>
            </li>
            <!-- Módulo de Marketing -->
            <li>
                <a href="#marketingSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-bullhorn"></i>
                    Marketing
                </a>
                <ul class="collapse list-unstyled" id="marketingSubmenu">
                    <li><a href="promocion.php">Promociones</a></li>
                    <li><a href="promocion_producto.php">Producto en Promoción</a></li>
                    <li><a href="destacado.php">Destacados</a></li>
                    <li><a href="tipo_descuento.php">Tipos de Descuento</a></li>
                </ul>
            </li>
            <!-- Módulo de Administración -->
            <li>
                <a href="#adminSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-cogs"></i>
                    Administración
                </a>
                <ul class="collapse list-unstyled" id="adminSubmenu">
                    <li><a href="usuario.php">Usuarios</a></li>
                    <li><a href="rol.php">Roles</a></li>
                    <li><a href="usuario_rol.php">Asignación de Roles</a></li>
                    <li><a href="privilegio.php">Privilegios</a></li>
                    <li><a href="rol_privilegio.php">Asignación de Privilegios</a></li>
                    <li><a href="metodo_pago.php">Métodos de Pago</a></li>
                </ul>
            </li>
             <!-- Módulo de Contenido -->
             <li>
                <a href="#faqSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-file-alt"></i>
                    Contenido
                </a>
                <ul class="collapse list-unstyled" id="faqSubmenu">
                    <li><a href="faq.php">Preguntas Frecuentes</a></li>
                    <li><a href="categoria_faq.php">Categorías de FAQ</a></li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="../index.php" class="article">Ver Tienda</a>
            </li>
             <li>
                <a href="login.php?action=logout" class="download">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Menú</span>
                </button>
            </div>
        </nav>
        <div class="container-fluid">

