<?php
require_once("sistema.php");
class Destacado extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO destacado (destacado, descripcion, fecha_inicio, fecha_fin)
                    VALUES (:destacado, :descripcion, :fecha_inicio, :fecha_fin)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":destacado", $data['destacado'], PDO::PARAM_STR);
            $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $sth -> bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
            $sth -> bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
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
        $sth = $this -> _DB -> prepare("SELECT * FROM destacado");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM destacado WHERE id_destacado = :id_destacado");
        $sth -> bindParam(":id_destacado", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE destacado SET destacado = :destacado, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_destacado = :id_destacado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":destacado", $data['destacado'], PDO::PARAM_STR);
                $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                $sth -> bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
                $sth -> bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
                $sth -> bindParam(":id_destacado", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM destacado WHERE id_destacado = :id_destacado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_destacado", $id, PDO::PARAM_INT);
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