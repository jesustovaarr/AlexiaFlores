<?php
require_once("sistema.php");
class Promocion extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO promocion (promocion, descripcion, imagen_banner, id_tipo_descuento)
                    VALUES (:promocion, :descripcion, :imagen_banner, :id_tipo_descuento)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":promocion", $data['promocion'], PDO::PARAM_STR);    
            $imagen_banner = $this -> cargarFotografia('promocion','imagen_banner');
            $sth -> bindParam(":imagen_banner", $imagen_banner, PDO::PARAM_STR);
            $sth -> bindParam(":id_tipo_descuento", $data['id_tipo_descuento'], PDO::PARAM_INT); 
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
        $sth = $this -> _DB -> prepare("SELECT p.*, td.tipo_descuento FROM promocion p JOIN tipo_descuento td ON p.id_tipo_descuento = td.id_tipo_descuento");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM promocion WHERE id_promocion = :id_promocion");
        $sth -> bindParam(":id_promocion", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE promocion SET promocion = :promocion, descripcion = :descripcion, id_tipo_descuento = :id_tipo_descuento WHERE id_promocion = :id_promocion";
                if(isset($_FILES['imagen_banner'])) {
                    if($_FILES['imagen_banner']['error'] == 0) {
                        $sql = "UPDATE promocion SET promocion = :promocion, descripcion = :descripcion, imagen_banner = :imagen_banner, id_tipo_descuento = :id_tipo_descuento WHERE id_promocion = :id_promocion";
                        $imagen_banner = $this -> cargarFotografia('promocion','imagen_banner');
                    }
                }
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":promocion", $data['promocion'], PDO::PARAM_STR);
                $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                if(isset($_FILES['imagen_banner'])) {
                    if($_FILES['imagen_banner']['error'] == 0) {
                        $sth -> bindParam(":imagen_banner", $imagen_banner, PDO::PARAM_STR);
                    }
                }
                $sth -> bindParam(":id_tipo_descuento", $data['id_tipo_descuento'], PDO::PARAM_INT);
                $sth -> bindParam(":id_promocion", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM promocion WHERE id_promocion = :id_promocion";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_promocion", $id, PDO::PARAM_INT);
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