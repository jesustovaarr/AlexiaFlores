<?php
require_once(__DIR__ . '/bootstrap.php');
require_once("./models/promocion.php");
include_once("./views/header.php");

$app = new Promocion();
$promociones = $app->read();

include_once("./views/promocion/index.php");
include_once("./views/footer.php");
?>