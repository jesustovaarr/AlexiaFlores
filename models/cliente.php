<?php
require_once("sistema.php");
class Cliente extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO cliente (id_genero, nombre, primer_apellido, segundo_apellido, telefono, fecha_nacimiento, foto_perfil, fecha_registro)
                    VALUES (:id_genero, :nombre, :primer_apellido, :segundo_apellido, :telefono, :fecha_nacimiento, :foto_perfil, NOW())";
            $sth = $this -> _DB -> prepare($sql);    
            $sth -> bindParam(":id_genero", $data['id_genero'], PDO::PARAM_INT);    
            $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);    
            $sth -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);    
            $sth -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);    
            $sth -> bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);    
            $sth -> bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);    
            $foto_perfil = $this -> cargarFotografia('cliente','foto_perfil');
            $sth -> bindParam(":foto_perfil", $foto_perfil, PDO::PARAM_STR);   
            $sth -> execute();
            $affectedRows = $sth -> rowCount();
            $sql = "INSERT INTO usuario (correo, contrasena)
                    VALUES (:correo, :contrasena)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $pwd = md5($data['contrasena']);
            $sth->bindParam(":contrasena", $pwd, PDO::PARAM_STR);
            $sth -> execute();
            $sql = "SELECT * FROM usuario
                    WHERE correo = :correo";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $sth -> execute();
            $usuario = $sth -> fetch(PDO::FETCH_ASSOC);
            $id_usuario = $usuario['id_usuario'];
            $sql = "INSERT INTO usuario_rol (id_rol, id_usuario)
                    VALUES (:id_rol, :id_usuario)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_rol", 2, PDO::PARAM_INT);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> execute();
            $sth -> bindParam(":id_rol", 3, PDO::PARAM_INT);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> execute();
            $sql = "SELECT * FROM cliente
                    ORDER BY id_cliente DESC LIMIT 1";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> execute();
            $cliente = $sth -> fetch(PDO::FETCH_ASSOC);
            $id_cliente = $cliente['id_cliente'];
            $SQL = "UPDATE cliente SET id_usuario = :id_usuario
                    WHERE id_cliente = :id_cliente";
            $sth = $this -> _DB -> prepare($SQL);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            $sth -> execute();
            $para = $data['correo'];
            $asunto = "Cuenta de Cliente Creada";
            $mensaje = "Su cuenta de cliente ha sido creada exitosamente.
                <br><br>Correo: " . $data['correo'] . "
                <br>Contraseña: " . $data['contrasena'] . "
                <br><br>Atentamente, Arreglos Alexia Flores.";
            $nombre = $data['nombre'] . " " . $data['primer_apellido'] . " " . $data['segundo_apellido'];
            $mail = $this->enviarCorreos($para, $asunto, $mensaje, $nombre);
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    function read() {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT c.*, u.correo, g.genero FROM cliente c JOIN usuario u ON c.id_usuario = u.id_usuario JOIN genero g ON c.id_genero = g.id_genero");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");
        $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }

    function update($data,$id) {
        if (!is_numeric($id)) {
            return null;
        }
        if ($this -> validate($data)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "UPDATE cliente SET id_usuario = :id_usuario, id_genero = :id_genero, nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento WHERE id_cliente = :id_cliente";
                if(isset($_FILES['foto_perfil'])) {
                    if($_FILES['foto_perfil']['error'] == 0) {
                        $sql = "UPDATE cliente SET id_usuario = :id_usuario, id_genero = :id_genero, nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento, foto_perfil = :foto_perfil WHERE id_cliente = :id_cliente";
                        $foto_perfil = $this -> cargarFotografia('cliente','foto_perfil');
                    }
                }
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);    
                $sth -> bindParam(":id_genero", $data['id_genero'], PDO::PARAM_INT);    
                $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);    
                $sth -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);    
                $sth -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);    
                $sth -> bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);    
                $sth -> bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);    
                if(isset($_FILES['foto_perfil'])) {
                    if($_FILES['foto_perfil']['error'] == 0) {
                        $sth -> bindParam(":foto_perfil", $foto_perfil, PDO::PARAM_STR);
                    }
                }  
                $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
                $sth -> execute();
                $affectedRows = $sth -> rowCount();
                $this -> _DB -> commit();
                return $affectedRows;
            } catch (Exception $ex) {
                $this -> _DB -> rollback();
            }
        }
        return null;
    }

    function delete($id) {
        if (is_numeric($id)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
                $sth -> execute();
                $affectedRows = $sth -> rowCount();
                $this -> _DB -> commit();
                return $affectedRows;
            } catch (Exception $ex) {
                $this -> _DB -> rollback();
            }
            return null;
        } else {
            return null;
        }
    }

    function validate($data) {
        return true;
    }

    function reporteClienteEdad() {
        $this -> connect();
        $sql = "WITH edades_cliente AS ( SELECT EXTRACT(YEAR FROM age(CURRENT_DATE, fecha_nacimiento)) AS edad
                                         FROM cliente
                                         WHERE fecha_nacimiento IS NOT NULL)
                SELECT
                    CASE
                        WHEN edad < 18 THEN 'Menores de 18'
                        WHEN edad BETWEEN 18 AND 25 THEN '18-25 años'
                        WHEN edad BETWEEN 26 AND 35 THEN '26-35 años'
                        WHEN edad BETWEEN 36 AND 45 THEN '36-45 años'
                        WHEN edad BETWEEN 46 AND 55 THEN '46-55 años'
                        ELSE 'Mayores de 55'
                    END AS rango,
                    COUNT(*) AS cantidad
                FROM edades_cliente
                GROUP BY rango
                ORDER BY rango ASC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        if ($sth -> rowCount() > 0) {
            return $sth -> fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null; 
        }
    }     
} 
?>