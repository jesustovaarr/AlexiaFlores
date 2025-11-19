<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once (__DIR__ . "/../config.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Sistema {
    var $_DSN = "pgsql:host=".DB_HOST.";dbname=".DB_NAME.";";
    var $_USER =DB_USER;
    var $_PASSWORD = DB_PASSWORD;
    var $_DB = null;

    function connect () {
            $this -> _DB = new PDO($this -> _DSN, $this -> _USER, $this -> _PASSWORD);
    }

    function login($correo, $contrasena){
        $contrasena = md5($contrasena);
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $this -> connect();
            $sql = "SELECT * FROM usuario
                    WHERE correo = :correo AND contrasena = :contrasena";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $correo, PDO::PARAM_STR);
            $sth -> bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $sth -> execute();
            if($sth -> rowCount() > 0) {
                $_SESSION['validado'] = true;
                $_SESSION['correo'] = $correo;
                $roles = $this -> getRoles($correo);
                $permisos = $this -> getPermisos($correo);
                $_SESSION['roles'] = $roles;
                $_SESSION['permisos'] = $permisos;
                return true;
            }
        }
        return false;
    } 
    
    function logout(){
        unset($_SESSION);
        session_destroy();
    }

        function getRoles($correo){
        $roles = array();
        $this -> connect();
        $sql = "SELECT r.rol FROM rol r JOIN usuario_rol ur ON r.id_rol = ur.id_rol
                                        JOIN usuario u ON ur.id_usuario = u.id_usuario
                                        WHERE correo = :correo";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":correo", $correo,PDO::PARAM_STR);
        $sth -> execute();
        if($sth -> rowCount() > 0) {
            while($fila = $sth -> fetch(PDO::FETCH_ASSOC)) {
                $roles[] = $fila['rol'];
            }
        }
        return $roles;
    } 
    
    function getPermisos($correo){
        $permisos = array();
        $this -> connect();
        $sql = "SELECT DISTINCT p.privilegio FROM rol r JOIN usuario_rol ur ON r.id_rol = ur.id_rol
                                                        JOIN usuario u ON ur.id_usuario = u.id_usuario
                                                        JOIN rol_privilegio rp ON r.id_rol = rp.id_rol
                                                        JOIN privilegio p ON rp.id_privilegio = p.id_privilegio
                                                        WHERE correo = :correo";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":correo", $correo,PDO::PARAM_STR);
        $sth -> execute();
        if($sth -> rowCount() > 0) {
            while($fila = $sth -> fetch(PDO::FETCH_ASSOC)) {
                $permisos[] = $fila['privilegio'];
            }
        }
        return $permisos;
    }

    function cargarFotografia($carpeta,$nombre) {
        $tipos = array('image/gif','image/jpeg','image/png');
        $maximo = 1000 * 1024; 
        if(isset($_FILES[$nombre])){
            $imagen = $_FILES[$nombre];
            if($imagen['error'] == 0) {
                if(in_array($imagen['type'],$tipos)){
                    if($imagen['size'] <= $maximo){
                        $n = rand(1,1000000);
                        $nombreArchivo = md5($imagen['name'].$imagen['size'].$n.'arreglos alexia flores');
                        $extension = explode('.',$imagen['name']);
                        $extension = $extension[count($extension)-1];
                        $nombreArchivo = $nombreArchivo.'.'.$extension;
                        $rutaFinal = __DIR__ .'/../images/'.$carpeta.'/'.$nombreArchivo;
                        if(!file_exists($rutaFinal)) {
                            if(move_uploaded_file($imagen['tmp_name'],$rutaFinal)) {
                                return $nombreArchivo;
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    public function obtenerImagenBase64($tmp_name) {
        if (empty($tmp_name) || !is_uploaded_file($tmp_name) || !file_exists($tmp_name)) {
            return null;
        }
        try {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $tipo_mime = finfo_file($finfo, $tmp_name);
            finfo_close($finfo);
            
            $datosImagen = file_get_contents($tmp_name);
            if ($datosImagen === false) {
                return null;
            }
            
            $datosBase64 = base64_encode($datosImagen);
            return "data:{$tipo_mime};base64,{$datosBase64}";
        } catch (Exception $e) {
            return null;
        }
    }

    function checarRol($rol){
        $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
        if(!in_array($rol,$roles)) {
            $alerta['mensaje'] = "Usted no tiene el rol adecuado";
            $alerta['tipo'] = "danger";
            include_once("./views/error.php");
            die();
        }
    }

        function enviarCorreos($para, $asunto, $mensaje, $nombre = null){
        require __DIR__ .'/../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '22030344@itcelaya.edu.mx';
        $mail->Password = PASSWORD_CORREO;
        $mail->setFrom('22030344@itcelaya.edu.mx', 'Jesus Alejandro Elguera Tovar');
        $mail->addAddress($para, $nombre ? $nombre : 'Arreglos Alexia Flores');
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function cambiarContrasena($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this -> connect();
        $token = bin2hex(random_bytes(16));
        $token = md5($token);
        $token = $token.md5('cruz azul campeon');
        $sql = "UPDATE usuario SET token = :token
                WHERE correo = :correo";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":token", $token, PDO::PARAM_STR);
        $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth -> execute();
        if($sth -> rowCount() > 0) {
            $para = $data['correo'];
            $asunto = "Recuperar contraseña Arreglos Alexia Flores";
            $mensaje = "Para cambiar su contraseña, por favor haga clic en el siguiente enlace:
                <br><br><a href='http://localhost:8080/proyecto_personal/panel/login.php?action=token&token=" . $token . "&correo=" . $data['correo'] . "'>Cambiar contraseña</a>
                <br><br>Atentamente, Administrador Arreglos Alexia Flores.";
            $mail = $this->enviarCorreos($para, $asunto, $mensaje);
            return true;
        } else {
            return false;
        }
    }

    function restablecerContrasena($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this -> connect();
        $contrasena = md5($data['contrasena']);
        $sql = "UPDATE usuario SET contrasena = :contrasena, token = NULL
                WHERE correo = :correo AND token = :token";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth -> bindParam(":token", $data['token'], PDO::PARAM_STR);
        $sth -> execute();
        if($sth -> rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>