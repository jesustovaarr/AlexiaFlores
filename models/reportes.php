<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once (__DIR__ . '/../models/producto.php');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

class Reportes extends Sistema {

    var $content;

    function __construct() {
        $this -> content = ob_get_clean(); 
    }

    private function DatosDeProductosQr($IdProducto) {
        $producto = new Producto();
        $DatosProducto = $producto->readOne($IdProducto);

        if ($DatosProducto) {
            $URLProducto = 'http://localhost:8080/proyecto_personal/index.php?id=' . $IdProducto;

            try {
                $writer = new PngWriter();
                $qrCode = new QrCode(
                    data: $URLProducto,
                    encoding: new Encoding('UTF-8'),
                    errorCorrectionLevel: ErrorCorrectionLevel::Low,
                    size: 150,
                    margin: 5
                );
                $result = $writer->write($qrCode);
                return 'data:' . $result->getMimeType() . ';base64,' . base64_encode($result->getString());
            } catch (Exception $e) {
                return null;
            }
        }
        return null;
    }


    function PDFDeProductos() {
        if (isset($_POST['IDsProductos'])) {
            $IDsProductos = $_POST['IDsProductos'];

            if (!empty($IDsProductos)) {
                try {
                    $html2pdf = new Html2Pdf('P', 'A4', 'es');
                    $html2pdf->setDefaultFont('Arial');
                    $productos = new Producto();

                    $content = '
                        <div style="text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 10mm;">
                            Códigos QR de Productos
                        </div>';

                    foreach ($IDsProductos as $id) {
                        $producto = $productos->readOne($id);
                        if ($producto) {
                            $DatosQR = $this->DatosDeProductosQr($id);
                            if ($DatosQR) {
                                $content .= '
                                    <div style="width: 90mm; height: 50mm; border: 1px solid #000; margin: 5mm; padding: 5mm; float: left; box-sizing: border-box;">
                                        <div style="font-size: 16px; font-weight: bold; text-align: center; margin-bottom: 5mm;">
                                            ' . $producto['producto'] . '
                                        </div>
                                        <div style="text-align: center;">
                                            <img src="' . $DatosQR . '" style="width: 40mm; height: 40mm;">
                                        </div>
                                    </div>';                                
                            }
                        }
                    }

                    $html2pdf->writeHTML($content);
                    $html2pdf->output('reporte_qr_productos.pdf');

                } catch (Html2PdfException $e) {
                    $html2pdf->clean();
                    $formatter = new ExceptionFormatter($e);
                    echo $formatter->getHtmlMessage();
                }
            } else {
                echo 'No se seleccionaron productos.';
            }
        } else {
            echo 'No se recibieron IDs de productos.';
        }
    }

    function QRDeProductos() {
        if (isset($_GET['id'])) {
            $IdProducto = $_GET['id'];

            $producto = new Producto();
            $DatosProducto = $producto->readOne($IdProducto);

            if ($DatosProducto) {
                $URLProducto = 'http://localhost:8080/proyecto_personal/index.php?id=' . $IdProducto;

                try {
                    $writer = new PngWriter();

                    $qrCode = new QrCode(
                        data: $URLProducto,
                        encoding: new Encoding('UTF-8'),
                        errorCorrectionLevel: ErrorCorrectionLevel::Low,
                        size: 150,
                        margin: 5
                    );

                    $result = $writer->write($qrCode);

                    header('Content-Type: ' . $result->getMimeType());
                    echo $result->getString();
                    exit;

                } catch (Exception $e) {
                    http_response_code(500);
                    echo 'Error al generar el QR: ' . $e->getMessage();
                }
            } else {
                http_response_code(404);
                echo 'Producto no encontrado.';
            }
        } else {
            http_response_code(400);
            echo 'ID de producto no proporcionado.';
        }
    }
}
?>