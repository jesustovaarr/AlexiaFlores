<?php
require_once("sistema.php");

class RolPrivilegio extends Sistema {
    
    public function create($id_rol, $id_privilegio) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            $sql = "INSERT INTO rol_privilegio (id_rol, id_privilegio)
                    VALUES (:id_rol, :id_privilegio)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $sth->bindParam(":id_privilegio", $id_privilegio, PDO::PARAM_INT);
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
        $sql = "SELECT r.rol, p.privilegio, rp.id_rol, rp.id_privilegio 
                FROM rol_privilegio rp 
                JOIN rol r ON rp.id_rol = r.id_rol 
                JOIN privilegio p ON rp.id_privilegio = p.id_privilegio";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id_rol, $id_privilegio) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            $sql = "DELETE FROM rol_privilegio WHERE id_rol = :id_rol AND id_privilegio = :id_privilegio";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $sth->bindParam(":id_privilegio", $id_privilegio, PDO::PARAM_INT);
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