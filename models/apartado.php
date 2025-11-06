<?php
require_once("sistema.php");
class Apartado extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO apartado (id_cliente, id_producto, cantidad, fecha_apartado, fecha_limite, id_estado_apartado)
                    VALUES (:id_cliente, :id_producto, :cantidad, :fecha_apartado, :fecha_limite, :id_estado_apartado)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);    
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT); 
            $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
            $sth -> bindParam(":fecha_apartado", $data['fecha_apartado'], PDO::PARAM_STR); 
            $sth -> bindParam(":fecha_limite", $data['fecha_limite'], PDO::PARAM_STR); 
            $sth -> bindParam(":id_estado_apartado", $data['id_estado_apartado'], PDO::PARAM_INT); 
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
        $sth = $this -> _DB -> prepare("SELECT a.*, c.nombre, p.producto, ea.estado_apartado 
                                     FROM apartado a 
                                     JOIN cliente c ON a.id_cliente = c.id_cliente
                                     JOIN producto p ON a.id_producto = p.id_producto
                                     JOIN estado_apartado ea ON a.id_estado_apartado = ea.id_estado_apartado");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM apartado WHERE id_apartado = :id_apartado");
        $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE apartado SET id_cliente = :id_cliente, id_producto = :id_producto, cantidad = :cantidad, fecha_apartado = :fecha_apartado, fecha_limite = :fecha_limite, id_estado_apartado = :id_estado_apartado WHERE id_apartado = :id_apartado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);    
                $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT); 
                $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
                $sth -> bindParam(":fecha_apartado", $data['fecha_apartado'], PDO::PARAM_STR); 
                $sth -> bindParam(":fecha_limite", $data['fecha_limite'], PDO::PARAM_STR); 
                $sth -> bindParam(":id_estado_apartado", $data['id_estado_apartado'], PDO::PARAM_INT); 
                $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
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
                $sql = "DELETE FROM apartado WHERE id_apartado = :id_apartado";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
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