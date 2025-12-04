<?php
require_once("sistema.php");

class DetalleApartado extends Sistema {

    function create($data) {
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $sql = "INSERT INTO detalle_apartado (id_apartado, id_producto, cantidad, precio_unitario) 
                    VALUES (:id_apartado, :id_producto, :cantidad, :precio_unitario)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_apartado", $data['id_apartado'], PDO::PARAM_INT);
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);
            $sth -> bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT);
            $sth -> bindParam(":precio_unitario", $data['precio_unitario'], PDO::PARAM_STR);
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

    function read($id_apartado) {
        if (!is_numeric($id_apartado)) 
            return [];
        $this -> connect();
        $sql = "SELECT d.*, p.producto as nombre_producto, i.imagen_producto
                FROM detalle_apartado d
                JOIN producto p ON d.id_producto = p.id_producto
                LEFT JOIN (SELECT id_producto, imagen_producto, ROW_NUMBER() OVER(PARTITION BY id_producto 
                                                                                  ORDER BY orden) as rn
                FROM imagen_producto) i ON d.id_producto = i.id_producto AND i.rn = 1
                WHERE d.id_apartado = :id_apartado";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_apartado", $id_apartado, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $this -> connect();
        $sql = "SELECT d.*, p.producto as nombre_producto 
                FROM detalle_apartado d
                JOIN producto p ON d.id_producto = p.id_producto
                ORDER BY d.id_apartado DESC, d.id_detalle_apartado ASC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id) {
        if (!is_numeric($id)) return null;
        $this -> connect();
        $sql = "SELECT * FROM detalle_apartado 
                WHERE id_detalle_apartado = :id_detalle_apartado";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_detalle_apartado", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetch(PDO::FETCH_ASSOC);
    }

    function update($data, $id) {
        if (!is_numeric($id)) return null;

        $this->connect();
        $sql = "UPDATE detalle_apartado SET cantidad = :cantidad WHERE id_detalle_apartado = :id_detalle_apartado";
        $sth = $this-> _DB -> prepare($sql);
        $sth->bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT);
        $sth->bindParam(":id_detalle_apartado", $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->rowCount();
    }

    function delete($id) {
        if (!is_numeric($id)) return null;
        $this -> connect();
        $transaccion_activa = $this -> _DB -> inTransaction();
        try {
            if (!$transaccion_activa) {
                $this -> _DB -> beginTransaction();
            }

            $sql = "DELETE FROM detalle_apartado WHERE id_detalle_apartado = :id_detalle_apartado";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_detalle_apartado", $id, PDO::PARAM_INT);
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