<?php
require_once("sistema.php");
class PromocionProducto extends Sistema {
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();
            $sql = "INSERT INTO promocion_producto (id_promocion, id_producto, valor_descuento, fecha_inicio, fecha_fin, activo)
                    VALUES (:id_promocion, :id_producto, :valor_descuento, :fecha_inicio, :fecha_fin, :activo)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":id_promocion", $data['id_promocion'], PDO::PARAM_INT);
            $sth -> bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);
            $sth -> bindParam(":valor_descuento", $data['valor_descuento'], PDO::PARAM_STR);
            $sth -> bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
            $sth -> bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
            $sth -> bindParam(":activo", $data['activo'], PDO::PARAM_BOOL);
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
        $sth = $this -> _DB -> prepare("SELECT pp.*, p.promocion, pr.producto FROM promocion_producto pp 
                                        JOIN promocion p ON pp.id_promocion = p.id_promocion
                                        JOIN producto pr ON pp.id_producto = pr.id_producto");
        $sth -> execute();
        $data = $sth -> fetchAll();
        return $data;
    }

    function readOne($id_promocion, $id_producto) {
        $this -> connect();
        $sth = $this -> _DB -> prepare("SELECT * FROM promocion_producto WHERE id_promocion = :id_promocion AND id_producto = :id_producto");
        $sth -> bindParam(":id_promocion", $id_promocion, PDO::PARAM_INT);
        $sth -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $sth -> execute();
        $data = $sth -> fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($data, $id_promocion, $id_producto) {
        if (!is_numeric($id_promocion) || !is_numeric($id_producto)) {
            return null;
        }
        if ($this -> validate($data)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "UPDATE promocion_producto SET id_promocion = :id_promocion_nueva, id_producto = :id_producto_nueva, valor_descuento = :valor_descuento, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, activo = :activo 
                        WHERE id_promocion = :id_promocion AND id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_promocion_nueva", $data['id_promocion'], PDO::PARAM_INT);
                $sth -> bindParam(":id_producto_nueva", $data['id_producto'], PDO::PARAM_INT);
                $sth -> bindParam(":valor_descuento", $data['valor_descuento'], PDO::PARAM_STR);
                $sth -> bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
                $sth -> bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
                $sth -> bindParam(":activo", $data['activo'], PDO::PARAM_BOOL);
                $sth -> bindParam(":id_promocion", $id_promocion, PDO::PARAM_INT);
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

    function delete($id_promocion, $id_producto) {
        if (is_numeric($id_promocion) && is_numeric($id_producto)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM promocion_producto WHERE id_promocion = :id_promocion AND id_producto = :id_producto";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_promocion", $id_promocion, PDO::PARAM_INT);
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