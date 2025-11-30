<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/contacto.php");
require_once("./models/cliente.php");

$app_contacto = new Contacto();
$app_cliente = new Cliente();
$alerta = null;

$nombre_cliente = '';
$email_cliente = '';
$id_cliente = null;
$esta_logueado = isset($_SESSION['validado']) && $_SESSION['validado'];


if (isset($_SESSION['validado']) && $_SESSION['validado'] && isset($_SESSION['correo'])) {
    $cliente_data = $app_cliente->getClientePorCorreo($_SESSION['correo']);
    if ($cliente_data) {
        $nombre_cliente = $cliente_data['nombre'] . ' ' . $cliente_data['primer_apellido'];
        $email_cliente = $cliente_data['correo'];
        $id_cliente = $cliente_data['id_cliente'];
    }
}

$asunto_form = $_POST['asunto'] ?? '';
$mensaje_form = $_POST['mensaje'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_contacto'])) {
    $data = [
        'nombre' => trim($_POST['nombre'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'asunto' => trim($_POST['asunto'] ?? ''),
        'mensaje' => trim($_POST['mensaje'] ?? ''),
        'id_cliente' => $id_cliente
    ];

    if (empty($data['nombre']) || empty($data['email']) || empty($data['asunto']) || empty($data['mensaje'])) {
        $alerta = ['mensaje' => 'Todos los campos marcados con * son obligatorios.', 'tipo' => 'danger'];
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $alerta = ['mensaje' => 'Por favor, introduce un correo electrónico válido.', 'tipo' => 'danger'];
    } else {
        $filas = $app_contacto->create($data);
        if ($filas) {
            $alerta = ['mensaje' => '¡Gracias! Tu mensaje ha sido enviado con éxito.', 'tipo' => 'success'];

            if (!isset($_SESSION['validado']) || !$_SESSION['validado']) {
                $nombre_cliente = '';
                $email_cliente = '';
            }
            $asunto_form = '';
            $mensaje_form = '';
        } else {
            $alerta = ['mensaje' => 'Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo.', 'tipo' => 'danger'];
        }
    }
}

include_once("./views/header.php");

if ($alerta) {
    $_SESSION['alerta'] = $alerta;
}

include_once("./views/contacto/index.php");
include_once("./views/footer.php");
?>