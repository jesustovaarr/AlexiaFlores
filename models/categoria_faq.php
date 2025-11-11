<?php
require_once("sistema.php");
class CategoriaFaq extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO categoria_faq (categoria_faq)
                    VALUES (:categoria_faq)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":categoria_faq", $data['categoria_faq'], PDO::PARAM_STR);    
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
        $sth = $this -> _DB -> prepare("SELECT *
                                        FROM categoria_faq");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT *
                                        FROM categoria_faq
                                        WHERE id_categoria_faq = :id_categoria_faq");
        $sth -> bindParam(":id_categoria_faq", $id, PDO::PARAM_INT);
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
            $sql = "UPDATE categoria_faq
                    SET categoria_faq = :categoria_faq
                    WHERE id_categoria_faq = :id_categoria_faq";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":categoria_faq", $data['categoria_faq'], PDO::PARAM_STR);
            $sth -> bindParam(":id_categoria_faq", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM categoria_faq
                        WHERE id_categoria_faq = :id_categoria_faq";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_categoria_faq", $id, PDO::PARAM_INT);
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