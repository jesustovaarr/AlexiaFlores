<?php
require_once("sistema.php");

class Direccion extends Sistema {

    public function create($data) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            if ($data['es_principal']) {
                $sql_update = "UPDATE direccion SET es_principal = false
                               WHERE id_cliente = :id_cliente";
                $sth_update = $this->_DB->prepare($sql_update);
                $sth_update->bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
                $sth_update->execute();
            }
            $sql = "INSERT INTO direccion (id_cliente, calle, numero, colonia, ciudad, estado, codigo_postal, es_principal) 
                    VALUES (:id_cliente, :calle, :numero, :colonia, :ciudad, :estado, :codigo_postal, :es_principal)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
            $sth->bindParam(":numero", $data['numero'], PDO::PARAM_STR);
            $sth->bindParam(":colonia", $data['colonia'], PDO::PARAM_STR);
            $sth->bindParam(":ciudad", $data['ciudad'], PDO::PARAM_STR);
            $sth->bindParam(":estado", $data['estado'], PDO::PARAM_STR);
            $sth->bindParam(":codigo_postal", $data['codigo_postal'], PDO::PARAM_STR);
            $sth->bindParam(":es_principal", $data['es_principal'], PDO::PARAM_BOOL);
            $sth->execute();
            $this->_DB->commit();
            return $sth->rowCount();
        } catch (Exception $e) {
            $this->_DB->rollBack();
            throw $e;
        }
    }

    public function read() {
        $this->connect();
        $sql = "SELECT d.*, c.nombre, c.primer_apellido 
                FROM direccion d 
                JOIN cliente c ON d.id_cliente = c.id_cliente";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $this->connect();
        $sql = "SELECT *
                FROM direccion
                WHERE id_direccion = :id_direccion";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_direccion", $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data, $id) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            if ($data['es_principal']) {
                $sql_update = "UPDATE direccion SET es_principal = false
                               WHERE id_cliente = :id_cliente AND id_direccion != :id_direccion";
                $sth_update = $this->_DB->prepare($sql_update);
                $sth_update->bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
                $sth_update->bindParam(":id_direccion", $id, PDO::PARAM_INT);
                $sth_update->execute();
            }
            $sql = "UPDATE direccion
                    SET id_cliente = :id_cliente, calle = :calle, numero = :numero, colonia = :colonia, 
                    ciudad = :ciudad, estado = :estado, codigo_postal = :codigo_postal, es_principal = :es_principal 
                    WHERE id_direccion = :id_direccion";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth->bindParam(":calle", $data['calle'], PDO::PARAM_STR);
            $sth->bindParam(":numero", $data['numero'], PDO::PARAM_STR);
            $sth->bindParam(":colonia", $data['colonia'], PDO::PARAM_STR);
            $sth->bindParam(":ciudad", $data['ciudad'], PDO::PARAM_STR);
            $sth->bindParam(":estado", $data['estado'], PDO::PARAM_STR);
            $sth->bindParam(":codigo_postal", $data['codigo_postal'], PDO::PARAM_STR);
            $sth->bindParam(":es_principal", $data['es_principal'], PDO::PARAM_BOOL);
            $sth->bindParam(":id_direccion", $id, PDO::PARAM_INT);
            $sth->execute();
            $this->_DB->commit();
            return $sth->rowCount();
        } catch (Exception $e) {
            $this->_DB->rollBack();
            throw $e;
        }
    }

    public function delete($id) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            $sql = "DELETE FROM direccion
                    WHERE id_direccion = :id_direccion";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_direccion", $id, PDO::PARAM_INT);
            $sth->execute();
            $this->_DB->commit();
            return $sth->rowCount();
        } catch (Exception $e) {
            $this->_DB->rollBack();
            throw $e;
        }
    }
}
?>