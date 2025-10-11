<?php
require_once("sistema.php");
class MetodoPago extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO metodo_pago (metodo_pago)
                    VALUES (:metodo_pago)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":metodo_pago", $data['metodo_pago'], PDO::PARAM_STR);    
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
        $sth = $this -> _DB -> prepare("SELECT * FROM metodo_pago");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago");
        $sth -> bindParam(":id_metodo_pago", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE metodo_pago SET metodo_pago = :metodo_pago WHERE id_metodo_pago = :id_metodo_pago";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":metodo_pago", $data['metodo_pago'], PDO::PARAM_STR);
                $sth -> bindParam(":id_metodo_pago", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_metodo_pago", $id, PDO::PARAM_INT);
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