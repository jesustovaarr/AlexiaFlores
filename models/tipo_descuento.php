<?php
require_once("sistema.php");
class TipoDescuento extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO tipo_descuento (tipo_descuento)
                    VALUES (:tipo_descuento)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":tipo_descuento", $data['tipo_descuento'], PDO::PARAM_STR);    
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
        $sth = $this -> _DB -> prepare("SELECT * FROM tipo_descuento");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM tipo_descuento
                                        WHERE id_tipo_descuento = :id_tipo_descuento");
        $sth -> bindParam(":id_tipo_descuento", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }

    function update($data,$id) {
        if (!is_numeric($id)) {
            return null;
        }
        $this -> connect();
        $this -> _DB -> beginTransaction();
        try {
            $sql = "UPDATE tipo_descuento SET tipo_descuento = :tipo_descuento
                    WHERE id_tipo_descuento = :id_tipo_descuento";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":tipo_descuento", $data['tipo_descuento'], PDO::PARAM_STR);
            $sth -> bindParam(":id_tipo_descuento", $id, PDO::PARAM_INT);
            $sth -> execute();
            $affectedRows = $sth -> rowCount();
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    function delete($id) {
        if (is_numeric($id)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM tipo_descuento
                        WHERE id_tipo_descuento = :id_tipo_descuento";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_tipo_descuento", $id, PDO::PARAM_INT);
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