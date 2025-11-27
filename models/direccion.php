<?php
require_once("sistema.php");

class Direccion extends Sistema {

    function create($data) {
        $this->connect();
        try {
            $contador = $this->conteoPorCliente($data['id_cliente']);
            if ($contador == 0) {
                $data['es_principal'] = true;
            }

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
            if ($this->_DB->inTransaction()) {
                $this->_DB->rollBack();
            }
            throw $e;
        }
    }

    function read() {
        $this->connect();
        $sql = "SELECT d.*, c.nombre, c.primer_apellido 
                FROM direccion d 
                JOIN cliente c ON d.id_cliente = c.id_cliente";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id) {
        $this->connect();
        $sql = "SELECT *
                FROM direccion
                WHERE id_direccion = :id_direccion";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_direccion", $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    function readFromCliente($id_cliente) {
        $this->connect();
        $sql = "SELECT d.* FROM direccion d WHERE d.id_cliente = :id_cliente";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function setPrincipal($id_direccion, $id_cliente) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();

            $sql_update = "UPDATE direccion SET es_principal = false WHERE id_cliente = :id_cliente";
            $sth_update = $this->_DB->prepare($sql_update);
            $sth_update->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            $sth_update->execute();

            $sql_update = "UPDATE direccion SET es_principal = true WHERE id_direccion = :id_direccion AND id_cliente = :id_cliente";
            $sth_update = $this->_DB->prepare($sql_update);
            $sth_update->bindParam(":id_direccion", $id_direccion, PDO::PARAM_INT);
            $sth_update->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            $sth_update->execute();

            $this->_DB->commit();
            return $sth_update->rowCount();
        } catch (Exception $e) {
            if ($this->_DB->inTransaction()) {
                $this->_DB->rollBack();
            }
            throw $e;
        }
    }


    function update($data, $id) {
        $this->connect();
        try {
            $direccion_actual = $this->readOne($id);
            if ($direccion_actual['es_principal'] && !$data['es_principal']) {
                $sql_conteo = "SELECT COUNT(*) as count FROM direccion 
                              WHERE id_cliente = :id_cliente AND es_principal = true";
                $sth_conteo = $this->_DB->prepare($sql_conteo);
                $sth_conteo -> bindParam(":id_cliente", $direccion_actual['id_cliente'], PDO::PARAM_INT);
                $sth_conteo -> execute();
                $conteo = $sth_conteo -> fetch(PDO::FETCH_ASSOC);
                if ($conteo['count'] <= 1) {
                    throw new Exception("Debe haber al menos una dirección principal.");
                }
            }
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
            $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
            $sth -> bindParam(":calle", $data['calle'], PDO::PARAM_STR);
            $sth -> bindParam(":numero", $data['numero'], PDO::PARAM_STR);
            $sth -> bindParam(":colonia", $data['colonia'], PDO::PARAM_STR);
            $sth -> bindParam(":ciudad", $data['ciudad'], PDO::PARAM_STR);
            $sth -> bindParam(":estado", $data['estado'], PDO::PARAM_STR);
            $sth -> bindParam(":codigo_postal", $data['codigo_postal'], PDO::PARAM_STR);
            $sth -> bindParam(":es_principal", $data['es_principal'], PDO::PARAM_BOOL);
            $sth -> bindParam(":id_direccion", $id, PDO::PARAM_INT);
            $sth ->execute();
            $this -> _DB ->commit();
            return $sth ->rowCount();
        } catch (Exception $e) {
            if ($this->_DB->inTransaction()) {
                $this->_DB->rollBack();
            }
            throw $e;
        }
    }

    function delete($id) {
        $this->connect();
        try {
            $direccion = $this->readOne($id);
            if ($direccion['es_principal']) {
                $conteo = $this->conteoPorCliente($direccion['id_cliente']);
                if ($conteo > 1) {
                    throw new Exception("No se puede eliminar la dirección principal, si desea eliminarla debe cambiar su direccion principal.");
                }
            }
            $this->_DB->beginTransaction();
            $sql = "DELETE FROM direccion
                    WHERE id_direccion = :id_direccion";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_direccion", $id, PDO::PARAM_INT);
            $sth->execute();
            $this->_DB->commit();
            return $sth->rowCount();
        } catch (Exception $e) {
            if ($this->_DB->inTransaction()) {
                $this->_DB->rollBack();
            }
            throw $e;
        }
    }

    function conteoPorCliente($id) {
        $this->connect();
        $sql = "SELECT COUNT(*) as count FROM direccion
                WHERE id_cliente = :id_cliente";
        $sth = $this->_DB->prepare($sql);
        $sth->bindParam(":id_cliente", $id, PDO::PARAM_INT);
        $sth->execute();
        $contador = $sth->fetch(PDO::FETCH_ASSOC);
        return $contador['count'];
    }

}
?>