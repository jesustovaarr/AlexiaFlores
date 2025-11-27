<?php
require_once(__DIR__ . '/bootstrap.php');

$clienteModel = new Cliente();
$action = $_SERVER['REQUEST_METHOD'] === 'POST' ? 'registrar' : 'form';

switch ($action) {
    case 'registrar':
        if (empty($_POST['nombre']) || empty($_POST['primer_apellido']) || empty($_POST['segundo_apellido']) ||empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['confirmar_contrasena']) || empty($_POST['telefono']) || empty($_POST['fecha_nacimiento']) || empty($_POST['id_genero'])) {
            $_SESSION['alerta'] = ['mensaje' => 'Todos los campos marcados con * son obligatorios.', 'tipo' => 'danger'];
            header('Location: registrarse.php');
            exit;
        }

        if ($_POST['contrasena'] !== $_POST['confirmar_contrasena']) {
            $_SESSION['alerta'] = ['mensaje' => 'Las contraseñas no coinciden.', 'tipo' => 'danger'];
            header('Location: registrarse.php');
            exit;
        }

        try {
            $nuevoCliente = $_POST;
            $resultado = $clienteModel->registrarCliente($nuevoCliente);

            if ($resultado) {
                $_SESSION['alerta'] = ['mensaje' => '¡Registro exitoso! Ahora puedes iniciar sesión.', 'tipo' => 'success'];
                header('Location: panel/login.php');
                exit;
            } else {
                throw new Exception("No se pudo completar el registro.");
            }
        } catch (Exception $e) {
            $_SESSION['alerta'] = ['mensaje' => $e->getMessage(), 'tipo' => 'danger'];
            header('Location: registrarse.php');
            exit;
        }
        break;

    case 'form':
    default:
        require_once(__DIR__ . '/models/genero.php');
        $generoModel = new Genero();
        $data['generos'] = $generoModel->read();

        require_once(__DIR__ . '/views/registro/header.php');
        require_once(__DIR__ . '/views/registro/form.php');
        require_once(__DIR__ . '/views/registro/footer.php');
        break;
}
?>
