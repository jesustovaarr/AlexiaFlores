<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/models/cliente.php');

$sesion_iniciada = isset($_SESSION['validado']) && $_SESSION['validado'];
$es_admin = false;
$nombre_usuario = 'Invitado';
$datos_cliente = null;

if ($sesion_iniciada) {
    $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : [];
    if (in_array('Administrador', $roles)) {
        $es_admin = true;
    } else {
        $cliente = new Cliente();
        $datos_cliente = $cliente -> getClientePorCorreo($_SESSION['correo']);
        if ($datos_cliente) {
            $nombre_usuario = $datos_cliente['nombre'];
        }
    }
}
?>
