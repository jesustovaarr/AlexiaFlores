<?php
require_once("sistema.php");
class Cliente extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO cliente (id_usuario, id_genero, nombre, primer_apellido, segundo_apellido, telefono, fecha_nacimiento, foto_perfil, fecha_registro)
                    VALUES (:id_usuario, :id_genero, :nombre, :primer_apellido, :segundo_apellido, :telefono, :fecha_nacimiento, :foto_perfil, NOW())";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);    
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
} 
?>