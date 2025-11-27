<?php
require_once("sistema.php");
class Cliente extends Sistema {
    
    function create($data){
        $this-> connect();
        try {
            $this -> _DB -> beginTransaction();

            $imagen_base64 = null;
            $foto_perfil = null;

            if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
                $imagen_base64 = $this->obtenerImagenBase64($_FILES['foto_perfil']['tmp_name']);
                $foto_perfil = $this->cargarFotografia('cliente', 'foto_perfil');
            }

            $sql = "INSERT INTO cliente (id_genero, nombre, primer_apellido, segundo_apellido, telefono, fecha_nacimiento, foto_perfil, fecha_registro, imagen_base64)
                    VALUES (:id_genero, :nombre, :primer_apellido, :segundo_apellido, :telefono, :fecha_nacimiento, :foto_perfil, NOW(), :imagen_base64)";
            $sth = $this -> _DB -> prepare($sql);    
            $sth -> bindParam(":id_genero", $data['id_genero'], PDO::PARAM_INT);    
            $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);    
            $sth -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);    
            $sth -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);    
            $sth -> bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);    
            $sth -> bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR); 
            $sth -> bindParam(":imagen_base64", $imagen_base64, PDO::PARAM_STR); 
            $sth -> bindParam(":foto_perfil", $foto_perfil, PDO::PARAM_STR);   
            $sth -> execute();
            $affectedRows = $sth -> rowCount();
            $sql = "INSERT INTO usuario (correo, contrasena)
                    VALUES (:correo, :contrasena)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $pwd = md5($data['contrasena']);
            $sth->bindParam(":contrasena", $pwd, PDO::PARAM_STR);
            $sth -> execute();
            $sql = "SELECT * FROM usuario
                    WHERE correo = :correo";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $sth -> execute();
            $usuario = $sth -> fetch(PDO::FETCH_ASSOC);
            $id_usuario = $usuario['id_usuario'];
            $sql = "INSERT INTO usuario_rol (id_rol, id_usuario)
                    VALUES (:id_rol, :id_usuario)";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> bindValue(":id_rol", 2, PDO::PARAM_INT);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> execute();
            $sth -> bindValue(":id_rol", 3, PDO::PARAM_INT);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> execute();
            $sql = "SELECT * FROM cliente
                    ORDER BY id_cliente DESC LIMIT 1";
            $sth = $this -> _DB -> prepare($sql);
            $sth -> execute();
            $cliente = $sth -> fetch(PDO::FETCH_ASSOC);
            $id_cliente = $cliente['id_cliente'];
            $SQL = "UPDATE cliente SET id_usuario = :id_usuario
                    WHERE id_cliente = :id_cliente";
            $sth = $this -> _DB -> prepare($SQL);
            $sth -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            $sth -> execute();
            $para = $data['correo'];
            $asunto = "Cuenta de Cliente Creada";
            $mensaje = "Su cuenta de cliente ha sido creada exitosamente.
                <br><br>Correo: " . $data['correo'] . "
                <br>Contraseña: " . $data['contrasena'] . "
                <br><br>Atentamente, Arreglos Alexia Flores.";
            $nombre = $data['nombre'] . " " . $data['primer_apellido'] . " " . $data['segundo_apellido'];
            $mail = $this->enviarCorreos($para, $asunto, $mensaje, $nombre);
            $this -> _DB -> commit();
            return $affectedRows;
        } catch (Exception $ex) {
            $this -> _DB -> rollback();
        }
        return null;
    }

    function read() {
        $this -> connect();
        $incluirBase64 = isset($_GET['include_base64']) && $_GET['include_base64'] === 'true';
        $sql = "SELECT c.id_cliente, c.id_usuario, c.id_genero, c.nombre, c.primer_apellido, 
                       c.segundo_apellido, c.telefono, c.fecha_nacimiento, c.foto_perfil, 
                       c.fecha_registro";
        
        if ($incluirBase64) {
            $sql .= ", c.imagen_base64";
        }

        $sql .= ", u.correo, g.genero 
                 FROM cliente c 
                 JOIN usuario u ON c.id_usuario = u.id_usuario 
                 JOIN genero g ON c.id_genero = g.id_genero";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        $data = $sth -> fetchAll(PDO::FETCH_ASSOC);        
        return $data;
    }

    function readOne($id) {
        $this -> connect();
        $incluirBase64 = isset($_GET['include_base64']) && $_GET['include_base64'] === 'true';
        $sql = "SELECT id_cliente, id_usuario, id_genero, nombre, primer_apellido, 
                       segundo_apellido, telefono, fecha_nacimiento, foto_perfil, 
                       fecha_registro";
        if ($incluirBase64) {
            $sql .= ", imagen_base64 ";
        }
        $sql .= "FROM cliente WHERE id_cliente = :id_cliente";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
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
                $sql = "UPDATE cliente SET id_usuario = :id_usuario, id_genero = :id_genero, nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento WHERE id_cliente = :id_cliente";
                
                $imagen_base64 = null;
                $foto_perfil = null;

                if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
                    $imagen_base64 = $this->obtenerImagenBase64($_FILES['foto_perfil']['tmp_name']);
                    $foto_perfil = $this->cargarFotografia('cliente', 'foto_perfil');
                    
                    $sql = "UPDATE cliente SET id_usuario = :id_usuario, id_genero = :id_genero, nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento, foto_perfil = :foto_perfil, imagen_base64 = :imagen_base64 WHERE id_cliente = :id_cliente";
                }

                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);    
                $sth -> bindParam(":id_genero", $data['id_genero'], PDO::PARAM_INT);    
                $sth -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);    
                $sth -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);    
                $sth -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);    
                $sth -> bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);    
                $sth -> bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);    
                
                if ($foto_perfil && $imagen_base64) {
                    $sth->bindParam(":imagen_base64", $imagen_base64, PDO::PARAM_STR);
                    $sth->bindParam(":foto_perfil", $foto_perfil, PDO::PARAM_STR);
                }
                
                $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
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

    function delete($id) {
        if (is_numeric($id)) {
            $this -> connect();
            $this -> _DB -> beginTransaction();
            try {
                $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
                $sth = $this -> _DB -> prepare($sql);
                $sth -> bindParam(":id_cliente", $id, PDO::PARAM_INT);
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

    function clientesPorEdad() {
        $this -> connect();
        $sql = "WITH edades_cliente AS ( SELECT EXTRACT(YEAR FROM age(CURRENT_DATE, fecha_nacimiento)) AS edad
                                         FROM cliente
                                         WHERE fecha_nacimiento IS NOT NULL)
                SELECT
                    CASE
                        WHEN edad < 18 THEN 'Menores de 18'
                        WHEN edad BETWEEN 18 AND 25 THEN '18-25 años'
                        WHEN edad BETWEEN 26 AND 35 THEN '26-35 años'
                        WHEN edad BETWEEN 36 AND 45 THEN '36-45 años'
                        WHEN edad BETWEEN 46 AND 55 THEN '46-55 años'
                        ELSE 'Mayores de 55'
                    END AS rango,
                    COUNT(*) AS cantidad
                FROM edades_cliente
                GROUP BY rango
                ORDER BY rango ASC";
        $sth = $this -> _DB -> prepare($sql);
        $sth -> execute();
        if ($sth -> rowCount() > 0) {
            return $sth -> fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null; 
        }
    } 
    
    function totalClientes() {
        $this->connect();
        $sql = "SELECT COUNT(*) as total FROM cliente";
        $sth = $this -> _DB ->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function getClientePorCorreo($correo) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->connect();
            $sql = "SELECT c.*, g.genero FROM cliente c
                    JOIN usuario u ON c.id_usuario = u.id_usuario
                    JOIN genero g ON c.id_genero = g.id_genero
                    WHERE u.correo = :correo";
            $sth = $this->_DB->prepare($sql);
            $sth->bindParam(":correo", $correo, PDO::PARAM_STR);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                return $sth->fetch(PDO::FETCH_ASSOC);
            }
        }
        return null;
    }

    function actualizarPerfil($id_cliente, $id_usuario, $data) {
        $this->connect();
        $this->_DB->beginTransaction();

        try {
            $partes_sql_cliente = [];
            $bind_params_cliente = [];

            $campos_cliente = ['nombre', 'primer_apellido', 'segundo_apellido', 'telefono', 'fecha_nacimiento'];
            foreach ($campos_cliente as $campo) {
                if (isset($data[$campo])) {
                    $partes_sql_cliente[] = "$campo = :$campo";
                    $bind_params_cliente[":$campo"] = $data[$campo];
                }
            }

            if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
                $imagen_base64 = $this -> obtenerImagenBase64($_FILES['foto_perfil']['tmp_name']);
                $foto_perfil = $this -> cargarFotografia('cliente', 'foto_perfil');
                if ($foto_perfil && $imagen_base64) {
                    $partes_sql_cliente[] = "foto_perfil = :foto_perfil";
                    $bind_params_cliente[":foto_perfil"] = $foto_perfil;
                    $partes_sql_cliente[] = "imagen_base64 = :imagen_base64";
                    $bind_params_cliente[":imagen_base64"] = $imagen_base64;
                }
            }

            if (!empty($partes_sql_cliente)) {
                $sql = "UPDATE cliente SET " . implode(', ', $partes_sql_cliente) . " WHERE id_cliente = :id_cliente";
                $sth = $this->_DB->prepare($sql);
                $sth->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
                foreach ($bind_params_cliente as $key => &$val) {
                    $sth->bindParam($key, $val);
                }
                $sth->execute();
            }

            if (!empty($data['contrasena_actual']) && !empty($data['contrasena_nueva'])) {
                if ($data['contrasena_nueva'] !== $data['contrasena_confirmar']) {
                    $_SESSION['alerta'] = ['mensaje' => 'Las nuevas contraseñas no coinciden.', 'tipo' => 'danger'];
                    $this->_DB->rollBack();
                    return false;
                }

                $contrasena_actual_md5 = md5($data['contrasena_actual']);
                $checar_contrasena_bd = "SELECT contrasena FROM usuario WHERE id_usuario = :id_usuario";
                $sth_check = $this->_DB->prepare($checar_contrasena_bd);
                $sth_check->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $sth_check->execute();
                $usuario_actual = $sth_check->fetch(PDO::FETCH_ASSOC);

                if (!$usuario_actual || $usuario_actual['contrasena'] !== $contrasena_actual_md5) {
                    $_SESSION['alerta'] = ['mensaje' => 'La contraseña actual es incorrecta.', 'tipo' => 'danger'];
                    $this->_DB->rollBack();
                    return false;
                }

                $contrasena_nueva_md5 = md5($data['contrasena_nueva']);
                $contrasena_actualizada = "UPDATE usuario SET contrasena = :contrasena_nueva WHERE id_usuario = :id_usuario";
                $sth_update = $this->_DB->prepare($contrasena_actualizada);
                $sth_update->bindParam(":contrasena_nueva", $contrasena_nueva_md5, PDO::PARAM_STR);
                $sth_update->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $sth_update->execute();
            }

            $this->_DB->commit();
            return true;

        } catch (Exception $e) {
            $this->_DB->rollBack();
            error_log("Error al actualizar perfil: " . $e->getMessage());
            return false;
        }
    }

    public function registrarCliente($data) {
        $this->connect();
        
        $sql_check = "SELECT id_usuario FROM usuario WHERE correo = :correo";
        $sth_check = $this->_DB->prepare($sql_check);
        $sth_check->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $sth_check->execute();
        if ($sth_check->rowCount() > 0) {
            throw new Exception('El correo electrónico ya está registrado.');
        }

        try {
            $this->_DB->beginTransaction();

            $sql_user = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
            $sth_user = $this->_DB->prepare($sql_user);
            $sth_user->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $contrasena = md5($data['contrasena']);
            $sth_user->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sth_user->execute();
            $id_usuario = $this->_DB->lastInsertId();

            $id_rol_cliente = 2;
            $sql_rol = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
            $sth_rol = $this->_DB->prepare($sql_rol);
            $sth_rol->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $sth_rol->bindParam(':id_rol', $id_rol_cliente, PDO::PARAM_INT);
            $sth_rol->execute();

            $sql_cliente = "INSERT INTO cliente (id_usuario, id_genero, nombre, primer_apellido, segundo_apellido, telefono, fecha_nacimiento, fecha_registro)
                            VALUES (:id_usuario, :id_genero, :nombre, :primer_apellido, :segundo_apellido, :telefono, :fecha_nacimiento, NOW())";
            $sth_cliente = $this->_DB->prepare($sql_cliente);
            $sth_cliente->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $sth_cliente->bindParam(':id_genero', $data['id_genero'], PDO::PARAM_INT);
            $sth_cliente->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $sth_cliente->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
            $sth_cliente->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
            $sth_cliente->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
            $sth_cliente->bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);
            $sth_cliente->execute();

            $this->_DB->commit();
            return true;

        } catch (Exception $e) {
            $this->_DB->rollBack();
            throw new Exception("Error al registrar el cliente: " . $e->getMessage());
        }
    }

} 
?>