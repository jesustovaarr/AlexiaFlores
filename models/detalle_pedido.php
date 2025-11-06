<?php
require_once("sistema.php");
class DetallePedido extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario)
                    VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_pedido", $data['id_pedido'], PDO::PARAM_INT);    
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT); 
            $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
            $sth -> bindParam(":precio_unitario", $data['precio_unitario'], PDO::PARAM_STR); 
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
        $sth = $this -> _DB -> prepare("SELECT dp.*, p.producto 
                                     FROM detalle_pedido dp
                                     JOIN producto p ON dp.id_producto = p.id_producto");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id_pedido, $id_producto) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM detalle_pedido WHERE id_pedido = :id_pedido AND id_producto = :id_producto");
        $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
        $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);        
        return $data;
    }

    function update($data, $id_pedido, $id_producto) {
        if (!is_numeric($id_pedido) || !is_numeric($id_producto)) {
            return null;
        }
        if ($this -> validate($data)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "UPDATE detalle_pedido SET cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
                $sth -> bindParam(":precio_unitario", $data['precio_unitario'], PDO::PARAM_STR); 
                $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
                $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
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

    function delete($id_pedido, $id_producto) {
        if (is_numeric($id_pedido) && is_numeric($id_producto)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM detalle_pedido WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
                $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
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