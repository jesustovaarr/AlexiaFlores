<?php
require_once("sistema.php");
class Producto extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO producto (producto, descripcion, precio, stock_disponible, id_categoria, id_destacado, fecha_creacion, fecha_actualizacion)
                    VALUES (:producto, :descripcion, :precio, :stock_disponible, :id_categoria, :id_destacado, NOW(), NOW())";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":producto", $data['producto'], PDO::PARAM_STR);    
            $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR); 
            $sth -> bindParam(":precio", $data['precio'], PDO::PARAM_STR); 
            $sth -> bindParam(":stock_disponible", $data['stock_disponible'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_destacado", $data['id_destacado'], PDO::PARAM_INT); 
            $sth -> execute();   
            $affectedRows = $sth -> rowCount(); 
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    function readDestacados() {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT p.*, c.categoria, d.destacado 
                                     FROM producto p 
                                     LEFT JOIN categoria c on p.id_categoria = c.id_categoria
                                     JOIN destacado d on p.id_destacado = d.id_destacado
                                     WHERE d.fecha_inicio <= NOW() AND d.fecha_fin >= NOW()");
        $sth -> execute();
        $data = $sth -> fetchAll(PDO::FETCH_ASSOC);        
        return $data;
    }

    function read() {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT p.*, c.categoria, d.destacado FROM producto p 
                                     LEFT JOIN categoria c on p.id_categoria = c.id_categoria
                                     LEFT JOIN destacado d on p.id_destacado = d.id_destacado");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM producto WHERE id_producto = :id_producto");
        $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE producto SET producto = :producto, descripcion = :descripcion, precio = :precio, 
                        stock_disponible = :stock_disponible, id_categoria = :id_categoria, id_destacado = :id_destacado, 
                        fecha_actualizacion = NOW() WHERE id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":producto", $data['producto'], PDO::PARAM_STR);
                $sth -> bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
                $sth -> bindParam(":precio", $data['precio'], PDO::PARAM_STR);
                $sth -> bindParam(":stock_disponible", $data['stock_disponible'], PDO::PARAM_INT);
                $sth -> bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_INT);
                $sth -> bindParam(":id_destacado", $data['id_destacado'], PDO::PARAM_INT);
                $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM producto WHERE id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
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

    function buscar($consulta) {
        $this->connect();
        $buscarConsulta = "%" . $consulta . "%";
        $sth = $this->_DB->prepare("SELECT p.*, c.categoria, d.destacado FROM producto p 
                                     LEFT JOIN categoria c on p.id_categoria = c.id_categoria
                                     LEFT JOIN destacado d on p.id_destacado = d.id_destacado
                                     WHERE p.producto ILIKE :consulta OR p.descripcion ILIKE :consulta");
        $sth->bindParam(":consulta", $buscarConsulta, PDO::PARAM_STR);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function obtenerImagenes($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM imagen_producto
                                               WHERE id_producto = :id_producto
                                               ORDER BY orden ASC");
        $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetchAll(PDO::FETCH_ASSOC);        
        return $data;
    }

    function obtenerPrimeraImagen($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM imagen_producto
                                               WHERE id_producto = :id_producto
                                               ORDER BY orden ASC LIMIT 1");
        $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }

    function obtenerSegundaImagen($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM imagen_producto
                                               WHERE id_producto = :id_producto AND orden = 2
                                               LIMIT 1");
        $sth -> bindParam(":id_producto", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }
} 
?>