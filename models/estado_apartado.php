<?php
require_once("sistema.php");
class EstadoApartado extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO estado_apartado (estado_apartado)
                    VALUES (:estado_apartado)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":estado_apartado", $data['estado_apartado'], PDO::PARAM_STR);    
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
        $sth = $this -> _DB -> prepare("SELECT * FROM estado_apartado");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM estado_apartado WHERE id_estado_apartado = :id_estado_apartado");
        $sth -> bindParam(":id_estado_apartado", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE estado_apartado SET estado_apartado = :estado_apartado WHERE id_estado_apartado = :id_estado_apartado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":estado_apartado", $data['estado_apartado'], PDO::PARAM_STR);
                $sth -> bindParam(":id_estado_apartado", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM estado_apartado WHERE id_estado_apartado = :id_estado_apartado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_estado_apartado", $id, PDO::PARAM_INT);
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