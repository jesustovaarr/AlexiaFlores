<?php
include_once("./views/login/header.php");
?>

<main class="contenedor-login">

    <div class="form-login">
        <div class="header-login">
            <a href="../index.php" class="logo-login">Arreglos Alexia Flores</a>
            <p>Ingresa tu correo electrónico para recuperar tu contraseña.</p>
        </div>

        <form action="login.php?action=cambio" method="POST">
            <div class="form-floating mb-3">
                <input name="correo" type="email" class="form-control" id="correo" required>
                <label for="correo">Correo Electrónico</label>
            </div>

            <button type="submit" name="enviar" class="btn btn-login">Recuperar Contraseña</button>

            <a href="login.php" class="link-olvidaste-contrasena">Volver a Iniciar Sesión</a>
        </form>
    </div>
</main>

<?php
include_once("./views/login/footer.php");
?>
