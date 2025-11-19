<?php
header("Content-Type: application/json; charset=UTF-8");
require_once("../../models/cliente.php");
$app = new Cliente();
//$app -> checarRol('Administrador');
$action = $_SERVER['REQUEST_METHOD'];
$data = array();
$id =isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'POST':
        $data = $_POST;
        if(!is_null($id)) {
            $filas = $app-> update($data,$id);
            $data['mensaje'] = 'Registro actualizado correctamente';
        } else {
            $filas = $app-> create($data);
            $data['mensaje'] = 'Registro creado correctamente';
        }
        break;

    case 'DELETE':
        if(!is_null($id)) {
            $filas = $app-> delete($id);
            if ($filas) {
                $data['mensaje'] = 'Registro eliminado correctamente';
            } else {
                $data['mensaje'] = 'Error al eliminar el registro';
            }
        } else {
            $data['mensaje'] = 'Falta el indetificador del registro a eliminar';
        }
        break;

    case 'GET':
    default:
        if(is_null($id)) {
            $data = $app-> read();
        } else {
            $data = $app-> readOne($id);

        }
    break;
}
echo json_encode($data,JSON_PRETTY_PRINT);
?>