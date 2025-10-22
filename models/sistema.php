<?php
session_start();
class Sistema {
    var $_DSN = "pgsql:host=postgres;dbname=proyecto";
    var $_USER ="user";
    var $_PASSWORD = "password";
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
                        $rutaFinal = '../images/'.$carpeta.'/'.$nombreArchivo;
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

    function checarRol($rol){
        $roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : array();
        if(!in_array($rol,$roles)) {
            $alerta['mensaje'] = "Usted no tiene el rol adecuado";
            $alerta['tipo'] = "danger";
            include_once("./views/error.php");
            die();
        }
    }
}
?>