<?php
include_once("../models/sistema.php");
$app = new Sistema();

if (isset($_SESSION['alerta'])) {
    $alerta = $_SESSION['alerta'];
    unset($_SESSION['alerta']);
}

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
switch ($action) {

    case 'recuperar':
        require_once("./views/login/recuperar.php");
        break;
    
    case 'cambio':
        $data = $_POST;
        $cambio = $app -> cambiarContrasena($data);
        if ($cambio) {
            $alerta['mensaje'] = "Se ha enviado un correo con las instrucciones para cambiar su contraseña";
            $alerta['tipo'] = "success";
            include_once("./views/alert.php");
            include_once("./views/login/login.php");
        } else {
            $alerta['mensaje'] = "Ocurrio un error al intentar cambiar la contraseña.";
            $alerta['tipo'] = "danger";
            include_once("./views/alert.php");
            include_once("./views/login/recuperar.php");
        }
        break;
    
    case 'token':
        require_once("./views/login/token.php");
        break;

    case 'restablecer':
        $data = $_POST;
        $restablecer = $app -> restablecerContrasena($data);
        if ($restablecer) {
            $alerta['mensaje'] = "Su contraseña ha sido cambiada correctamente.";
            $alerta['tipo'] = "success";
            include_once("./views/alert.php");
            include_once("./views/login/login.php");
        } else {
            $alerta['mensaje'] = "Ocurrio un error al intentar cambiar la contraseña.";
            $alerta['tipo'] = "danger";
            include_once("./views/alert.php");
            include_once("./views/login/login.php");
        }
        break;

    case 'logout':
        $app->logout();
        session_start();
        $_SESSION['alerta'] = [
            'mensaje' => "Usted ha salido correctamente del sistema.",
            'tipo' => "success"
        ];
        header("Location: ../index.php");
        exit();

    case 'login':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $app -> login($correo, $contrasena);
            if ($login) {
                $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
                    if (in_array('Administrador', $roles)) {
                        header("Location: index.php");
                        exit();
                    } else {
                        header("Location: ../index.php");
                        exit();
                      }
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrecta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                include_once("./views/login/login.php"); 
            }
        } else {
            if(isset($alerta)) include_once("./views/alert.php");
            include_once("./views/login/login.php");
        }
        break;

    default:
        if(isset($alerta)) include_once("./views/alert.php");
        include_once("./views/login/login.php");
        break;
}
?>