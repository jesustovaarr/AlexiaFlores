<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once (__DIR__ . "/config.php");

@session_start();

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

// Access Token de Prueba
MercadoPagoConfig::setAccessToken(ACCESSTOKEN);

$preferencia = null;
$mensaje_error = null;

try {
    // array de articulos desde el carrito de la sesión
    $articulos = [];
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $articulos[] = [
                "id" => $id_producto,
                "title" => $producto['producto'],
                "quantity" => (int)$producto['cantidad'],
                "unit_price" => (float)$producto['precio']
            ];
        }
    }

    // Agregar el envío si hay articulos en el carrito
    if (!empty($articulos)) {
        $envio = 20.00;
        $articulos[] = [
            "id" => "envio",
            "title" => "Costo de Envío",
            "quantity" => 1,
            "unit_price" => $envio
        ];
    }

    // Crear la preferencia de pago si hay articulos
    if (!empty($articulos)) {
        $cliente = new PreferenceClient();
        $preferencia = $cliente->create([
            "items" => $articulos,
            "payer" => [
                "email" => "TEST_USER_123456@testuser.com"
            ],
            "statement_descriptor" => "ARREGLOS ALEXIA FLORES",
            "external_reference" => "CDP001",
        ]);
    } else {
        $mensaje_error = "Tu carrito de compras está vacío.";
    }
} catch (Exception $e) {
    $mensaje_error = "Error al crear la preferencia de pago: " . $e->getMessage();
    error_log($mensaje_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <?php if ($preferencia) : ?>
                    <h2>Finaliza tu Compra</h2>
                    <p>Haz clic en el botón para completar el pago de forma segura con Mercado Pago.</p>
                    <div id="wallet_container"></div>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <h2>No se puede procesar el pago</h2>
                        <p><?php echo $mensaje_error ?? 'Ocurrió un error inesperado.'; ?></p>
                        <a href="productos.php" class="btn btn-primary mt-3">Volver a la tienda</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($preferencia) : ?>
    <script>
        const mp = new MercadoPago('<?php echo PUBLICKEY; ?>', {
            locale: 'es-MX'
        });
        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: '<?php echo $preferencia->id; ?>',
            },
            customization: {
                texts: {
                    valueProp: 'security_safety',
                },
            },
        });
    </script>
    <?php endif; ?>
</body>
</html>