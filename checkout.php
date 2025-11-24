<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/cliente.php");

include_once("./views/header.php");

$app = new Cliente();

include_once("./views/checkout/index.php");
include_once("./views/footer.php");
?>