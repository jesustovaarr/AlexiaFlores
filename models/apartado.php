<?php
require_once("sistema.php");
class Apartado extends Sistema {
    function create($data) {
        $this->connect();
        $transaccion_activa = $this -> _DB-> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this-> _DB ->beginTransaction();
            }
            
            $sql = "INSERT INTO apartado (id_cliente, fecha_apartado, fecha_limite, total_apartado, id_estado_apartado) 
                    VALUES (:id_cliente, NOW(), :fecha_limite, :total_apartado, :id_estado_apartado)";
            $sth = $this-> _DB -> prepare($sql);
            $sth->bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth->bindParam(":fecha_limite", $data['fecha_limite'], PDO::PARAM_STR);
            $sth->bindParam(":total_apartado", $data['total_apartado'], PDO::PARAM_STR);
            $sth->bindParam(":id_estado_apartado", $data['id_estado_apartado'], PDO::PARAM_INT);
            $sth->execute();
            $id_apartado = $this-> _DB -> lastInsertId();

            if (!$transaccion_activa) {
                $this->_DB->commit();
            }
            return $id_apartado;
        } catch (Exception $ex) {
            if (!$transaccion_activa) {
                $this->_DB->rollBack();
            }
            throw $ex;
        }
    }

    function read() {
        $this -> connect();
        $sql = "SELECT a.*, cl.nombre AS nombre_cliente, cl.primer_apellido AS apellido_cliente, ea.estado_apartado
                FROM apartado a
                JOIN cliente cl ON a.id_cliente = cl.id_cliente
                JOIN estado_apartado ea ON a.id_estado_apartado = ea.id_estado_apartado
                ORDER BY a.fecha_apartado DESC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id) {
        if (!is_numeric($id)) return null;
        $this -> connect();
        $sql = "SELECT * FROM apartado WHERE id_apartado = :id_apartado";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    function readFromCliente($id_cliente) {
        if (!is_numeric($id_cliente)) return [];
        $this -> connect();
        $sql = "SELECT a.*, ea.estado_apartado 
                FROM apartado a
                JOIN estado_apartado ea ON a.id_estado_apartado = ea.id_estado_apartado
                WHERE a.id_cliente = :id_cliente
                ORDER BY a.fecha_apartado DESC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function update($data, $id) {
        if (!is_numeric($id)) return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }
            $sql = "UPDATE apartado SET id_cliente = :id_cliente, fecha_limite = :fecha_limite, total_apartado = :total_apartado, id_estado_apartado = :id_estado_apartado
                    WHERE id_apartado = :id_apartado";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth -> bindParam(":fecha_limite", $data['fecha_limite'], PDO::PARAM_STR);
            $sth -> bindParam(":total_apartado", $data['total_apartado'], PDO::PARAM_STR);
            $sth -> bindParam(":id_estado_apartado", $data['id_estado_apartado'], PDO::PARAM_INT);
            $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
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

    function updateTotal($id_apartado, $nuevo_total) {
        if (!is_numeric($id_apartado)) 
            return null;

        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }
            
            $sql = "UPDATE apartado SET total_apartado = :nuevo_total WHERE id_apartado = :id_apartado";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":nuevo_total", $nuevo_total, PDO::PARAM_STR);
            $sth -> bindParam(":id_apartado", $id_apartado, PDO::PARAM_INT);
            $sth -> execute();
            $rowCount = $sth->rowCount();

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

    function delete($id) {
        if (!is_numeric($id)) 
            return null;

        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }
            
            $sql = "DELETE FROM apartado WHERE id_apartado = :id_apartado";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_apartado", $id, PDO::PARAM_INT);
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