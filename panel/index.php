<?php
include_once("../models/sistema.php");
require_once("../models/cliente.php");
$app = new Sistema();
$appCliente = new Cliente();
$app -> checarRol('Index');
include_once("./views/header.php");
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
switch ($action) {
    default:
        $clientesPorEdad = $appCliente -> clientesPorEdad();
        $totalClientes = $appCliente -> totalClientes();
        include_once("./views/index/index.php");
        break;
}
include_once("./views/footer.php");
?>