<?php
require_once("sistema.php");
class Pedido extends Sistema {

    function create($data){
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $total_pedido = isset($data['total_pedido']) ? $data['total_pedido'] : 0;

            $sql = "INSERT INTO pedido (id_cliente, fecha_pedido, total_pedido, id_estado_pedido, id_metodo_pago)
                    VALUES (:id_cliente, NOW(), :total_pedido, :id_estado_pedido, :id_metodo_pago)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth -> bindParam(":total_pedido", $total_pedido, PDO::PARAM_STR);
            $sth -> bindParam(":id_estado_pedido", $data['id_estado_pedido'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_metodo_pago", $data['id_metodo_pago'], PDO::PARAM_INT); 
            $sth -> execute();   
            $id_pedido = $this -> _DB -> lastInsertId();

            if (!$transaccion_activa) {
                $this -> _DB -> commit();
            }
            return $id_pedido;
        } catch (Exception $ex) {
            if (!$transaccion_activa) {
                $this -> _DB -> rollBack();
            }
            throw $ex;
        }
    }

    function read() {
        $this -> connect();
        $sql = "SELECT p.*, cl.nombre AS nombre_cliente, cl.primer_apellido, ep.estado_pedido, mp.metodo_pago 
                FROM pedido p 
                JOIN cliente cl ON p.id_cliente = cl.id_cliente
                JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id) {
        $this -> connect();
        $sql = "SELECT * FROM pedido WHERE id_pedido = :id_pedido";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetch(PDO::FETCH_ASSOC);
    }

    function update($data, $id) {
        if (!is_numeric($id)) 
            return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }
            
            $sql = "UPDATE pedido SET id_cliente = :id_cliente, total_pedido = :total_pedido, id_estado_pedido = :id_estado_pedido, id_metodo_pago = :id_metodo_pago WHERE id_pedido = :id_pedido";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth -> bindParam(":total_pedido", $data['total_pedido'], PDO::PARAM_STR); 
            $sth -> bindParam(":id_estado_pedido", $data['id_estado_pedido'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_metodo_pago", $data['id_metodo_pago'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
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

    function updateTotal($id_pedido, $nuevo_total) {
        if (!is_numeric($id_pedido)) 
            return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }
            
            $sql = "UPDATE pedido SET total_pedido = :nuevo_total WHERE id_pedido = :id_pedido";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":nuevo_total", $nuevo_total, PDO::PARAM_STR);
            $sth -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
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

    function readFromCliente($id_cliente) {
        $this -> connect();
        $sql = "SELECT p.*, ep.estado_pedido, mp.metodo_pago 
                FROM pedido p 
                JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago
                WHERE p.id_cliente = :id_cliente
                ORDER BY p.fecha_pedido DESC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function delete($id) {
        if (!is_numeric($id)) return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this->_DB->beginTransaction();
            }

            $sql_detalles = "DELETE FROM detalle_pedido WHERE id_pedido = :id_pedido";
            $sth_detalles = $this -> _DB -> prepare($sql_detalles);
            $sth_detalles -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
            $sth_detalles -> execute();

            $sql = "DELETE FROM pedido WHERE id_pedido = :id_pedido";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
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