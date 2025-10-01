<?php
require_once("sistema.php");
class Categoria extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO categoria (categoria, descripcion)
                    VALUES (:categoria, :descripcion)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);    
            $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR); 
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
        $sth = $this -> _DB -> prepare("SELECT * FROM categoria");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM categoria WHERE id_categoria = :id_categoria");
        $sth -> bindParam(":id_categoria", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE categoria SET categoria = :categoria, descripcion = :descripcion WHERE id_categoria = :id_categoria";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
                $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                $sth -> bindParam(":id_categoria", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_categoria", $id, PDO::PARAM_INT);
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