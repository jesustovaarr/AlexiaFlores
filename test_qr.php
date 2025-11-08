<?php
require (__DIR__ . '/vendor/autoload.php');

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

try {

    $writer = new PngWriter();

    $qrCode = new QrCode(
        data: 'Mi QR de prueba',
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::Low,
        size: 300,
        margin: 10
    );

    $result = $writer->write($qrCode);

    header('Content-Type: '.$result->getMimeType());

    echo $result->getString();

} catch (Exception $e) {
    header('Content-Type: text/plain');
    echo 'Error al generar el QR: ' . $e->getMessage();
  }
?>