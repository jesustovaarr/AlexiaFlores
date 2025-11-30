<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/cliente.php");
require_once("./models/direccion.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['carrito'])) {
    $_SESSION['alerta'] = ['mensaje' => 'Tu carrito está vacío. Añade productos antes de proceder al pago.', 'tipo' => 'warning'];
    header('Location: carrito.php');
    exit();
}

if (!isset($_SESSION['validado']) || !$_SESSION['validado']) {
    $_SESSION['redirigir_a'] = 'checkout.php';
    $_SESSION['alerta'] = ['mensaje' => 'Necesitas iniciar sesión o registrarte para proceder al pago.', 'tipo' => 'danger'];
    header('Location: registrarse.php');
    exit();
}

$clienteModel = new Cliente();
$direccionModel = new Direccion();

$cliente = $clienteModel->getClientePorCorreo($_SESSION['correo']);
$id_cliente = $cliente['id_cliente'];


$direcciones = $direccionModel->readFromCliente($id_cliente);
$direccion_principal = null;

foreach ($direcciones as $dir) {
    if ($dir['es_principal']) {
        $direccion_principal = $dir;
        break;
    }
}

if (!$direccion_principal && !empty($direcciones)) {
    $direccion_principal = $direcciones[0];
}

include_once("./views/header.php");

$data['cliente'] = $cliente;
$data['direccion_principal'] = $direccion_principal;
include_once("./views/checkout/index.php");
include_once("./views/footer.php");
?>