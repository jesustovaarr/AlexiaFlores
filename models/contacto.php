<?php
require_once("sistema.php");
class Contacto extends Sistema {
    function create($data){
        $this-> connect();
        $sql = "INSERT INTO contacto (nombre, email, asunto, mensaje, fecha_envio, id_cliente) VALUES (:nombre, :email, :asunto, :mensaje, NOW(), :id_cliente)";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $sth -> bindParam(":email", $data['email'], PDO::PARAM_STR);
        $sth -> bindParam(":asunto", $data['asunto'], PDO::PARAM_STR);
        $sth -> bindParam(":mensaje", $data['mensaje'], PDO::PARAM_STR);
        $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> rowCount();
    }

    function read() {
        $this -> connect();
        $sql = "SELECT c.*, cl.nombre as cliente FROM contacto c LEFT JOIN cliente cl ON c.id_cliente = cl.id_cliente";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    function readOne($id) {
        $this -> connect();
        $sql = "SELECT * FROM contacto WHERE id_contacto = :id_contacto";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_contacto", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> fetch(PDO::FETCH_ASSOC);
    }

    function update($data,$id) {
        $this -> connect();
        $sql = "UPDATE contacto SET nombre = :nombre, email = :email, asunto = :asunto, mensaje = :mensaje, id_cliente = :id_cliente WHERE id_contacto = :id_contacto";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $sth -> bindParam(":email", $data['email'], PDO::PARAM_STR);
        $sth -> bindParam(":asunto", $data['asunto'], PDO::PARAM_STR);
        $sth -> bindParam(":mensaje", $data['mensaje'], PDO::PARAM_STR);
        $sth -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_INT);
        $sth -> bindParam(":id_contacto", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> rowCount();
    }

    function delete($id) {
        $this -> connect();
        $sql = "DELETE FROM contacto WHERE id_contacto = :id_contacto";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_contacto", $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth -> rowCount();
    }
}
?>