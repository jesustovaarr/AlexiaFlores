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
        $app -> logout();
        $alerta['mensaje'] = "Usted ha salido correctamente del sistema";
        $alerta['tipo'] = "success";
        include_once("./views/alert.php");
        include_once("./views/login/login.php");
        break;

    case 'login':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $app -> login($correo, $contrasena);
            if ($login) {
                header("Location: index.php");
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrecta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
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