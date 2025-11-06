<?php
require_once("sistema.php");
class ImagenProducto extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO imagen_producto (id_producto, imagen_producto, orden)
                    VALUES (:id_producto, :imagen_producto, :orden)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);    
            $imagen_producto = $this -> cargarFotografia('producto', 'imagen_producto');
            $sth -> bindParam(":imagen_producto", $imagen_producto, PDO::PARAM_STR); 
            $sth -> bindParam(":orden", $data['orden'], PDO::PARAM_INT); 
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
        $sth = $this -> _DB -> prepare("SELECT ip.*, p.producto FROM imagen_producto ip JOIN producto p on ip.id_producto = p.id_producto");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM imagen_producto WHERE id_imagen = :id_imagen");
        $sth -> bindParam(":id_imagen", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE imagen_producto SET id_producto = :id_producto, orden = :orden WHERE id_imagen = :id_imagen";
                if(isset($_FILES['imagen_producto'])) {
                    if($_FILES['imagen_producto']['error'] == 0) {
                        $sql = "UPDATE imagen_producto SET id_producto = :id_producto, imagen_producto = :imagen_producto, orden = :orden WHERE id_imagen = :id_imagen";
                        $imagen_producto = $this -> cargarFotografia('producto','imagen_producto');
                    }
                }
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);
                $sth -> bindParam(":orden", $data['orden'], PDO::PARAM_INT);
                if(isset($_FILES['imagen_producto'])) {
                    if($_FILES['imagen_producto']['error'] == 0) {
                        $sth -> bindParam(":imagen_producto", $imagen_producto, PDO::PARAM_STR);
                    }
                }  
                $sth -> bindParam(":id_imagen", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM imagen_producto WHERE id_imagen = :id_imagen";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_imagen", $id, PDO::PARAM_INT);
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