<main class="container my-5">
    <div class="card card-body mb-4 encabezado-seccion-card">
        <h1 class="titulo-seccion">Contáctanos</h1>
        <p class="descripcion-seccion">
            ¿Tienes alguna pregunta, comentario o sugerencia? ¡Nos encantaría escucharte!
            Utiliza el siguiente formulario para enviarnos un mensaje y te responderemos a la brevedad posible en tu correo registrado o el correo que proporcionaste.
        </p>
    </div>    
    
    <div class="row">
        <div class="col-md-7">
            <div class="card p-4">
                <form action="contacto.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_cliente; ?>" <?php echo $esta_logueado ? 'disabled' : ''; ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email_cliente; ?>" <?php echo $esta_logueado ? 'disabled' : ''; ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="asunto" class="form-label">Asunto *</label>
                        <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo $asunto_form; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje *</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required><?php echo $mensaje_form; ?></textarea>
                    </div>
                    <button type="submit" name="enviar_contacto" class="btn btn-tarjeta">Enviar Mensaje</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4 h-100 contact-info-card">
                <h4 class="mb-3">Información de Contacto</h4>
                <p><i class="fas fa-map-marker-alt me-2"></i>Calle Ignacio Allende #214, Rincón de Tamayo</p>
                <p><i class="fas fa-phone me-2"></i><a href="tel:+524611234567" class="text-decoration-none text-dark">+52 461 279 96 49</a></p>
                <p><i class="fas fa-envelope me-2"></i><a href="mailto:contacto@arreglosalexiaflores.com" class="text-decoration-none text-dark">contacto_alexia_flores@gmail.com</a></p>
                <p><i class="fas fa-clock me-2"></i>Lunes a Sábado: 12:00 PM - 8:00 PM</p>
            </div>
        </div>

    </div>
</main>