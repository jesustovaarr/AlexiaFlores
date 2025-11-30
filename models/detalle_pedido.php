<?php
require_once("sistema.php");
class DetallePedido extends Sistema {
    
    function create($data){
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $sql = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario)
                    VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_pedido", $data['id_pedido'], PDO::PARAM_INT);    
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT); 
            $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
            $sth -> bindParam(":precio_unitario", $data['precio_unitario'], PDO::PARAM_STR); 
            $sth -> execute();   
            $rowCount = $sth -> rowCount(); 

            if (!$transaccion_activa) {
                $this -> _DB -> commit();
            }
            return $rowCount;
        } catch (Exception $ex) {
            if (!$transaccion_activa) {
                $this -> _DB -> rollBack();
            }
            throw $ex;
        }
    }

    function read($id_pedido) {
        if (!is_numeric($id_pedido)) 
            return [];
        $this -> connect();
        $sql = "SELECT dp.*, p.producto as nombre_producto, i.imagen_producto 
                FROM detalle_pedido dp
                JOIN producto p ON dp.id_producto = p.id_producto
                LEFT JOIN (SELECT id_producto, imagen_producto, ROW_NUMBER() OVER(PARTITION BY id_producto 
                                                                                  ORDER BY orden) as rn
                FROM imagen_producto) i ON dp.id_producto = i.id_producto AND i.rn = 1
                WHERE dp.id_pedido = :id_pedido";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $this -> connect();
        $sql = "SELECT dp.*, p.producto as nombre_producto
                FROM detalle_pedido dp
                JOIN producto p ON dp.id_producto = p.id_producto
                ORDER BY dp.id_pedido DESC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id_pedido, $id_producto) {
        $this -> connect();
        $sql = "SELECT * FROM detalle_pedido
                WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
        $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetch(PDO::FETCH_ASSOC);
    }

    function update($data, $id_pedido, $id_producto) {
        if (!is_numeric($id_pedido) || !is_numeric($id_producto)) 
            return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $sql = "UPDATE detalle_pedido SET cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT); 
            $sth -> bindParam(":precio_unitario", $data['precio_unitario'], PDO::PARAM_STR); 
            $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
            $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $sth -> execute();
            $rowCount = $sth -> rowCount();

            if (!$transaccion_activa) {
                $this -> _DB -> commit();
            }
            return $rowCount;
        } catch (Exception $ex) {
            if (!$transaccion_activa) {
                $this -> _DB -> rollBack();
            }
            throw $ex;
        }
    }

    function delete($id_pedido, $id_producto) {
        if (!is_numeric($id_pedido) || !is_numeric($id_producto)) 
            return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $sql = "DELETE FROM detalle_pedido WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
            $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $sth -> execute();
            $rowCount = $sth -> rowCount();

            if (!$transaccion_activa) {
                $this -> _DB -> commit();
            }
            return $rowCount;
        } catch (Exception $ex) {
            if (!$transaccion_activa) {
                $this -> _DB -> rollBack();
            }
            throw $ex;
        }
    }
} 
?>