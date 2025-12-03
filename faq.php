<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/models/faq.php');

$faq_model = new Faq();
$lista_faqs = $faq_model -> read();

$faqs_agrupadas = [];
if ($lista_faqs) {
    foreach ($lista_faqs as $faq) {
        $nombre_categoria = $faq['categoria_faq'];
        if (!isset($faqs_agrupadas[$nombre_categoria])) {
            $faqs_agrupadas[$nombre_categoria] = [];
        }
        $faqs_agrupadas[$nombre_categoria][] = $faq;
    }
}

include_once('views/header.php');
include_once('views/faq/index.php');
include_once('views/footer.php');
?>