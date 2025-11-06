<?php
require_once("sistema.php");
class Faq extends Sistema {
    public function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO faq (pregunta, respuesta, id_categoria_faq)
                    VALUES (:pregunta, :respuesta, :id_categoria_faq)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":pregunta", $data['pregunta'], PDO::PARAM_STR);
            $sth -> bindParam(":respuesta", $data['respuesta'], PDO::PARAM_STR);
            $sth -> bindParam(":id_categoria_faq", $data['id_categoria_faq'], PDO::PARAM_INT);
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
        $sth = $this -> _DB -> prepare("SELECT f.id_faq, f.pregunta, f.respuesta, cf.categoria_faq
                                        FROM faq f
                                        JOIN categoria_faq cf on f.id_categoria_faq = cf.id_categoria_faq");
        $sth -> execute();
        $data = $sth -> fetchAll();
        return $data;
    }

    public function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT *
                                        FROM faq
                                        WHERE id_faq = :id_faq");
        $sth -> bindParam(":id_faq", $id, PDO::PARAM_INT);
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
            $sql = "UPDATE faq
                    SET pregunta = :pregunta,
                        respuesta = :respuesta,
                        id_categoria_faq = :id_categoria_faq
                    WHERE id_faq = :id_faq";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":pregunta", $data['pregunta'], PDO::PARAM_STR);
            $sth -> bindParam(":respuesta", $data['respuesta'], PDO::PARAM_STR);
            $sth -> bindParam(":id_categoria_faq", $data['id_categoria_faq'], PDO::PARAM_INT);
            $sth -> bindParam(":id_faq", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM faq
                        WHERE id_faq = :id_faq";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_faq", $id, PDO::PARAM_INT);
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