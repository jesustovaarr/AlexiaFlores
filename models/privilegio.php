<?php
require_once("sistema.php");
class Privilegio extends Sistema {
    public function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO privilegio (privilegio) VALUES (:privilegio)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);    
            $sth -> execute();   
            $affectedRows = $sth -> rowCount(); 
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    public function read() {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM privilegio");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    public function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM privilegio WHERE id_privilegio = :id_privilegio");
        $sth -> bindParam(":id_privilegio", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }

    public function update($data,$id) {
        if (!is_numeric($id)) {
            return null;
        }
        $this -> connect();
        $this -> _DB -> beginTransaction();
        try {
            $sql = "UPDATE privilegio SET privilegio = :privilegio WHERE id_privilegio = :id_privilegio";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
            $sth -> bindParam(":id_privilegio", $id, PDO::PARAM_INT);
            $sth -> execute();
            $affectedRows = $sth -> rowCount();
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    public function delete($id) {
        if (is_numeric($id)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM privilegio WHERE id_privilegio = :id_privilegio";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_privilegio", $id, PDO::PARAM_INT);
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
}
?>