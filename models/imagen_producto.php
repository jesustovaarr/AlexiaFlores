<?php
require_once("sistema.php");
class ImagenProducto extends Sistema {

    function create($data){
        $this-> connect();
        try {

            if ($this -> ordenarPorProducto($data['id_producto'], $data['orden'])) {
                throw new Exception("El orden especificado ya existe para este producto.");
            }

            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO imagen_producto (id_producto, imagen_producto, orden)
                    VALUES (:id_producto, :imagen_producto, :orden)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);    
            $imagen_producto = $this -> cargarFotografia('producto', 'imagen_producto');
            if (!$imagen_producto) {
                throw new Exception("No se pudo cargar la imagen del producto.");
            }
            $sth -> bindParam(":imagen_producto", $imagen_producto, PDO::PARAM_STR); 
            $sth -> bindParam(":orden", $data['orden'], PDO::PARAM_INT); 
            $sth -> execute();   
            $affectedRows = $sth -> rowCount(); 
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            if ($this->_DB->inTransaction()) {
                $this -> _DB -> rollback(); 
            }
            throw $ex;
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
        $this -> connect();
        
        try {
 
            if ($this -> ordenarPorProducto($data['id_producto'], $data['orden'], $id)) {
                throw new Exception("El orden especificado ya existe para otra imagen de este producto.");
            }

            $this -> _DB -> beginTransaction();
            $sql = "UPDATE imagen_producto SET id_producto = :id_producto, orden = :orden";
            $params = [
                ":id_producto" => $data['id_producto'],
                ":orden" => $data['orden'],
                ":id_imagen" => $id
            ];

            if(isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] == 0) {
                $imagen_producto_nombre = $this->cargarFotografia('producto', 'imagen_producto');
                if (!$imagen_producto_nombre) {
                    throw new Exception("No se pudo cargar la nueva imagen del producto.");
                }
                $sql .= ", imagen_producto = :imagen_producto";
                $params[":imagen_producto"] = $imagen_producto_nombre;
            }

            $sql .= " WHERE id_imagen = :id_imagen";
            $sth = $this->_DB->prepare($sql);
            $sth->execute($params);
            
            $affectedRows = $sth -> rowCount(); 
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            if ($this->_DB->inTransaction()) {
                $this -> _DB -> rollback(); 
            }
            throw $ex;
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

    function ordenarPorProducto($id_producto, $orden, $id_imagen_excluir = null) {
        $this -> connect();
        $sql = "SELECT id_imagen FROM imagen_producto WHERE id_producto = :id_producto AND orden = :orden";
        if ($id_imagen_excluir !== null) {
            $sql .= " AND id_imagen != :id_imagen_excluir";
        }
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $sth -> bindParam(":orden", $orden, PDO::PARAM_INT);
        if ($id_imagen_excluir !== null) {
            $sth -> bindParam(":id_imagen_excluir", $id_imagen_excluir, PDO::PARAM_INT);
        }
        $sth -> execute();
        return $sth -> fetch(PDO::FETCH_ASSOC);
    }
} 
?>