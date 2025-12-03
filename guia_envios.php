<?php
require_once(__DIR__ . '/bootstrap.php');
include_once('views/header.php');
?>

<main class="container my-5 contenido-estatico">
    <div class="row">
        <div class="col-12 encabezado-pagina-estatica">
            <h1 class="display-4 trocchi-font">Guía de Envíos</h1>
            <p class="lead">Llevamos belleza y alegría a tu puerta.</p>
            <hr class="my-4">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p>En Arreglos Alexia Flores, nos esforzamos por garantizar que tus artículos lleguen en perfectas condiciones. Actualmente, nuestro servicio de envío se limita exclusivamente a la localidad de <strong>Rincón de Tamayo</strong>, asegurando así la máxima calidad y rapidez en cada entrega.</p>

            <h2 class="trocchi-font mt-5">Tarifas y Horarios de Entrega</h2>
            <p>Entendemos la importancia de la puntualidad, especialmente cuando se trata de un regalo especial. A continuación, detallamos nuestras opciones de envío:</p>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Zona de Envío</th>
                            <th>Costo</th>
                            <th>Horario de Entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rincón de Tamayo (Zona Norte)</td>
                            <td>$20.00 MXN</td>
                            <td>Los productos seleccionados se entregarán entre las 17:00 y las 18:00 horas del día que selecciones.</td>
                        </tr>
                        <tr>
                            <td>Rincón de Tamayo (Zona Sur)</td>
                            <td>$20.00 MXN</td>
                            <td>Los productos seleccionados se entregarán entre las 18:00 y las 19:00 horas del día que selecciones.</td>
                        </tr>
                        <tr>
                            <td>Rincón de Tamayo (Zona Centro)</td>
                            <td>$20.00 MXN</td>
                            <td>Los productos seleccionados se entregarán entre las 19:00 y las 20:00 horas del día que selecciones.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="trocchi-font mt-5">Horarios de Reparto</h2>
            <p>Nuestros horarios de reparto son los siguientes:</p>
            <ul>
                <li><strong>Lunes a Viernes:</strong> 17:00 PM a 20:00 PM.</li>
                <li><strong>Sábado y Domingo:</strong> No se realizan entregas.</li>
            </ul>
            <p>Los pedidos realizados fuera de este horario serán procesados y enviados al siguiente día hábil.</p>

            <h2 class="trocchi-font mt-5">Consideraciones Importantes</h2>
            <ul>
                <li><strong>Confirmación del Pedido:</strong> Tu pedido lo recibimos a partir de que tu pago es aprobado y te mostramos la confirmacion de tu pedido en la seccion de "Mis Pedidos" dentro del panel del cliente.</li>
                <li><strong>Recepción del Pedido:</strong> Es responsabilidad del cliente asegurarse de que alguien esté disponible en la dirección de entrega para recibir el paquete. Si nuestro repartidor no encuentra a nadie, intentaremos contactarte por teléfono. En caso de no poder concretar la entrega, el pedido regresará a la tienda y se podrá acordar un nuevo envío con un costo adicional. Por lo que si pasa esto ponte en contacto con nosotros.</li>
                <li><strong>Datos de Entrega:</strong> Por favor, verifica que todos los datos de la dirección de entrega sean correctos, esto para evitar contratiempos.</li>
            </ul>
        </div>
    </div>
</main>

<?php
include_once('views/footer.php');
?>