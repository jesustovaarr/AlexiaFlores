<?php
require_once("sistema.php");
class Pedido extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO pedido (id_cliente, fecha_pedido, total_pedido, id_estado_pedido, id_metodo_pago)
                    VALUES (:id_cliente, :fecha_pedido, :total_pedido, :id_estado_pedido, :id_metodo_pago)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);    
            $sth -> bindParam(":fecha_pedido", $data['fecha_pedido'], PDO::PARAM_STR); 
            $sth -> bindParam(":total_pedido", $data['total_pedido'], PDO::PARAM_STR); 
            $sth -> bindParam(":id_estado_pedido", $data['id_estado_pedido'], PDO::PARAM_INT); 
            $sth -> bindParam(":id_metodo_pago", $data['id_metodo_pago'], PDO::PARAM_INT); 
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
        $sth = $this -> _DB -> prepare("SELECT p.*, c.nombre, ep.estado_pedido, mp.metodo_pago 
                                     FROM pedido p 
                                     JOIN cliente c ON p.id_cliente = c.id_cliente
                                     JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                                     JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago");
        $sth -> execute();
        $data = $sth -> fetchAll();        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM pedido WHERE id_pedido = :id_pedido");
        $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE pedido SET id_cliente = :id_cliente, fecha_pedido = :fecha_pedido, total_pedido = :total_pedido, id_estado_pedido = :id_estado_pedido, id_metodo_pago = :id_metodo_pago WHERE id_pedido = :id_pedido";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);    
                $sth -> bindParam(":fecha_pedido", $data['fecha_pedido'], PDO::PARAM_STR); 
                $sth -> bindParam(":total_pedido", $data['total_pedido'], PDO::PARAM_STR); 
                $sth -> bindParam(":id_estado_pedido", $data['id_estado_pedido'], PDO::PARAM_INT); 
                $sth -> bindParam(":id_metodo_pago", $data['id_metodo_pago'], PDO::PARAM_INT); 
                $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
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

    function readFromCliente($id) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT p.*, ep.estado_pedido, mp.metodo_pago 
                                        FROM pedido p 
                                        JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                                        JOIN metodo_pago mp ON p.id_metodo_pago = mp.id_metodo_pago
                                        WHERE p.id_cliente = :id_cliente");
        $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetchAll(PDO::FETCH_ASSOC);        
        return $data;
    }

    function delete($id) {
        if (is_numeric($id)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM pedido WHERE id_pedido = :id_pedido";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_pedido", $id, PDO::PARAM_INT);
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