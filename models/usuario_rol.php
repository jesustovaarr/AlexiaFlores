<?php
require_once("sistema.php");

class UsuarioRol extends Sistema {
    
    public function create($id_usuario, $id_rol) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
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
        $sql = "SELECT u.correo, r.rol, ur.id_usuario, ur.id_rol 
                FROM usuario_rol ur 
                JOIN usuario u ON ur.id_usuario = u.id_usuario 
                JOIN rol r ON ur.id_rol = r.id_rol";
        $sth = $this->_DB->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id_usuario, $id_rol) {
        $this->connect();
        try {
            $this->_DB->beginTransaction();
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario AND id_rol = :id_rol";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
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