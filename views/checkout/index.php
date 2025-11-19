<div class="container my-5">
    <div class="row">

        <div class="col-lg-7 contenedor-formulario-checkout">
            <h4 class="titulo-checkout">Detalles de la Entrega del Destinatario</h4>
            <form action="#" method="post" class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nombre" placeholder="Primer nombre" required>
                    </div>

                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="apellido" placeholder="Apellido" required>
                    </div>

                    <div class="col-12">
                        <input type="text" class="form-control" id="direccion" placeholder="Calle" required>
                    </div>

                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="numero" placeholder="Número" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="colonia" placeholder="Colonia" required>
                    </div>

                    <div class="col-md-5">
                        <select class="form-select" id="ciudad" placeholder="Ciudad" required>
                            <option>Celaya</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select" id="estado" placeholder="Estado" required>
                            <option>Guanajuato</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" id="codigo_postal" placeholder="Codigo Postal" required>
                            <option>38150</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <input type="tel" class="form-control" id="telefono"
                            placeholder="Tu numero de telefono para contactarte" required>
                    </div>

                </div>

                <hr class="my-4">

                <h4 class="titulo-checkout">Tarifas de Entrega</h4>
                <div class="aviso-checkout">
                    <strong>$20.00 de costo de envio en Rincón de Tamayo.</strong>
                </div>

                <hr class="my-4">

                <h4 class="titulo-checkout">Método de Pago</h4>
                <div class="d-grid gap-2">
                    <a href="generar_pago.php" class="btn btn-dark btn-lg" target="_blank">Pagar con Mercado Pago</a>
                    <button class="btn btn-dark btn-lg" type="submit">Pagar con Efectivo</button>
                </div>
            </form>
        </div>

        <div class="col-lg-5 resumen-checkout">

            <ul class="list-group mb-3">
                <?php
        $productos = 0;
        $envio = 20; // Tarifa de envío
        $total = 0;
        if (!empty($_SESSION['carrito'])):
            foreach ($_SESSION['carrito'] as $item):
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
        ?>

                <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">

                    <div class="d-flex align-items-center">

                        <div class="imagen-producto-checkout me-3">
                            <img src="images/producto/<?php echo $item['imagen']; ?>"
                                alt="<?php echo $item['producto']; ?>" class="rounded">

                            <span class="circulo-cantidad-producto">
                                <?php echo $item['cantidad']; ?>
                            </span>
                        </div>

                        <div>
                            <h6 class="my-0"><?php echo $item['producto']; ?></h6>
                        </div>
                    </div>

                    <span class="text-muted">$<?php echo number_format($subtotal, 2); ?></span>
                </li>
                <?php 
            endforeach;
        endif; 
        ?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Subtotal</span>
                    <strong>$<?php echo number_format($total, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Envío</span>
                    <strong>$<?php echo number_format($envio, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <?php $total += $envio ?>
                    <strong>$<?php echo number_format($total, 2); ?></strong>
                </li>
            </ul>

        </div>
    </div>
</div>