<div class="container my-5">
    <div class="row">

        <div class="col-lg-7 contenedor-formulario-checkout">
            
            <h4 class="titulo-checkout">Detalles de Contacto</h4>
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?php echo $data['cliente']['nombre'] . ' ' . $data['cliente']['primer_apellido']; ?></p>
                    <p><strong>Correo:</strong> <?php echo $data['cliente']['correo']; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $data['cliente']['telefono']; ?></p>
                </div>
            </div>

            <h4 class="titulo-checkout">Dirección de Envío</h4>
            <?php if (isset($data['direccion_principal'])): ?>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Dirección:</strong> <?php echo $data['direccion_principal']['calle'] . ' ' . $data['direccion_principal']['numero']; ?></p>
                        <p><strong>Colonia:</strong> <?php echo $data['direccion_principal']['colonia']; ?></p>
                        <p><strong>Ciudad:</strong> <?php echo $data['direccion_principal']['ciudad'] . ', ' . $data['direccion_principal']['estado'] . ' ' . $data['direccion_principal']['codigo_postal']; ?></p>
                        <a href="cliente.php?action=direcciones" class="btn btn-outline-secondary mt-2">Cambiar o añadir dirección</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <p><strong>No tienes una dirección de envío.</strong></p>
                    <p>Por favor, añade una dirección en tu panel de cliente para poder continuar.</p>
                    <a href="cliente.php?action=direcciones" class="btn btn-warning">Añadir Dirección</a>
                </div>
            <?php endif; ?>

            <hr class="my-4">

            <h4 class="titulo-checkout">Método de Pago</h4>
            <div class="d-grid gap-2">
                <?php if (isset($data['direccion_principal'])): ?>
                    <button id="btn-mercadopago" type="button" class="btn btn-dark btn-lg">Pagar con Mercado Pago</button>
                <?php else: ?>
                    <button class="btn btn-dark btn-lg" disabled>Pagar con Mercado Pago</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-5 resumen-checkout">
            <h4 class="titulo-checkout">Resumen de la Compra</h4>
            <ul class="list-group mb-3">
                <?php
                $subtotal_carrito = 0;
                $envio = 20.00;
                if (!empty($_SESSION['carrito'])):
                    foreach ($_SESSION['carrito'] as $item):
                        $subtotal_item = $item['precio'] * $item['cantidad'];
                        $subtotal_carrito += $subtotal_item;
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
                    <div class="d-flex align-items-center">
                        <div class="imagen-producto-checkout me-3">
                            <img src="images/producto/<?php echo $item['imagen']; ?>" alt="<?php echo $item['producto']; ?>" class="rounded">
                            <span class="circulo-cantidad-producto"><?php echo $item['cantidad']; ?></span>
                        </div>
                        <div>
                            <h6 class="my-0"><?php echo $item['producto']; ?></h6>
                        </div>
                    </div>
                    <span class="text-muted">$<?php echo number_format($subtotal_item, 2); ?></span>
                </li>
                <?php 
                    endforeach;
                endif; 
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Subtotal</span>
                    <strong>$<?php echo number_format($subtotal_carrito, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Envío</span>
                    <strong>$<?php echo number_format($envio, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between fs-5">
                    <strong>Total</strong>
                    <strong>$<?php echo number_format($subtotal_carrito + $envio, 2); ?></strong>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="js/checkout.js"></script>