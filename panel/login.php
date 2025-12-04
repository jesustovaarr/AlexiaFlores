<?php
include_once("../models/sistema.php");
$app = new Sistema();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
switch ($action) {

    case 'recuperar':
        require_once("./views/login/recuperar.php");
        break;
    
    case 'cambio':
        $data = $_POST;
        $cambio = $app -> cambiarContrasena($data);
        if ($cambio) {
            $_SESSION['alerta'] = [
                'mensaje' => "Se ha enviado un correo con las instrucciones para cambiar su contraseña",
                'tipo' => "success"
            ];
            include_once("./views/login/login.php");
        } else {
            $_SESSION['alerta'] = [
                'mensaje' => "Ocurrio un error al intentar cambiar la contraseña.",
                'tipo' => "danger"
            ];
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
            $_SESSION['alerta'] = [
                'mensaje' => "Su contraseña ha sido cambiada correctamente.",
                'tipo' => "success"
            ];
            include_once("./views/login/login.php");
        } else {
            $_SESSION['alerta'] = [
                'mensaje' => "Ocurrio un error al intentar cambiar la contraseña.",
                'tipo' => "danger"
            ];
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
                if (isset($_SESSION['redirigir_a'])) {
                    $url_redirigir = $_SESSION['redirigir_a'];
                    unset($_SESSION['redirigir_a']);
                    header("Location: ../" . $url_redirigir);
                    exit();
                }

                $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
                    if (in_array('Administrador', $roles)) {
                        header("Location: index.php");
                        exit();
                    } else {
                        header("Location: ../index.php");
                        exit();
                      }
            } else {
                $_SESSION['alerta'] = [
                    'mensaje' => "Correo o contraseña incorrecta",
                    'tipo' => "danger"
                ];
                include_once("./views/login/login.php"); 
            }
        } else {
            include_once("./views/login/login.php");
        }
        break;

    default:
        include_once("./views/login/login.php");
        break;
}
?>