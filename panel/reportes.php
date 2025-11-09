<?php
require_once(__DIR__ . '/../models/sistema.php');
require_once(__DIR__ . '/../models/producto.php');
require_once(__DIR__ . '/../models/reportes.php');
$app = new Reportes();
ob_start();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
switch ($action) {
    case 'PDFProductos':
        $app -> checarRol('Administrador');
        $app -> PDFDeProductos();
        break;

    case 'QRProductos':
        $app -> checarRol('Administrador');
        $app -> QRDeProductos();
        break;

    default: 
        break;
}
?>