<?php
require_once("sistema.php");
class Usuario extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO usuario (correo, contrasena, id_rol)
                    VALUES (:correo, :contrasena, :id_rol)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);    
            $sth -> bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);    
            $sth -> bindParam(":id_rol", $data['id_rol'], PDO::PARAM_INT);    
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
        $sth = $this -> _DB -> prepare("SELECT u.*, r.rol FROM usuario u JOIN rol r ON u.id_rol = r.id_rol");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $sth -> bindParam(":id_usuario", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE usuario SET correo = :correo, contrasena = :contrasena, id_rol = :id_rol WHERE id_usuario = :id_usuario";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
                $sth -> bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
                $sth -> bindParam(":id_rol", $data['id_rol'], PDO::PARAM_INT);
                $sth -> bindParam(":id_usuario", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_usuario", $id, PDO::PARAM_INT);
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