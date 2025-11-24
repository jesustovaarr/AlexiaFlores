<?php
require_once(__DIR__ . '/bootstrap.php');

if (!$sesion_iniciada || $es_admin) {
    header("Location: panel/login.php");
    exit();
}

require_once(__DIR__ . '/views/header.php');
require_once(__DIR__ . '/views/cliente/index.php');
require_once(__DIR__ . '/views/footer.php');
?>