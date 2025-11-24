<?php
require_once(__DIR__ . '/bootstrap.php');

if (!$sesion_iniciada || $es_admin) {
    header("Location: panel/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = new Cliente();
    $id_cliente = $datos_cliente['id_cliente'];
    $id_usuario = $datos_cliente['id_usuario'];
    
    $resultado = $cliente -> actualizarPerfil($id_cliente, $id_usuario, $_POST);

    if ($resultado) {
        if (!isset($_SESSION['alerta'])) {
            $_SESSION['alerta'] = ['mensaje' => 'Tu perfil ha sido actualizado correctamente.', 'tipo' => 'success'];
        }
    } else {
        if (!isset($_SESSION['alerta'])) {
            $_SESSION['alerta'] = ['mensaje' => 'Ocurrió un error al actualizar tu perfil.', 'tipo' => 'danger'];
        }
    }

    header("Location: cliente.php");
    exit();
}

require_once(__DIR__ . '/views/header.php');
require_once(__DIR__ . '/views/cliente/editar_perfil.php');
require_once(__DIR__ . '/views/footer.php');
?>