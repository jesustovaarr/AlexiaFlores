<?php
include_once("./views/login/header.php");
?>

<main class="contenedor-login">

    <div class="form-login">
        <div class="header-login">
            <a href="../index.php" class="logo-login">Arreglos Alexia Flores</a>
            <p>Bienvenido!</p>
            <p>Inicia sesión en tu cuenta.</p>
        </div>

        <form action="login.php?action=login" method="POST">
            <div class="form-floating mb-3">
                <input name="correo" type="email" class="form-control" id="correo" required>
                <label for="correo">Correo Electrónico</label>
            </div>

            <div class="form-floating mb-4">
                <input name="contrasena" type="password" class="form-control" id="contrasena" required>
                <label for="contrasena">Contraseña</label>
            </div>

            <button type="submit" name="enviar" class="btn btn-login">Iniciar Sesión</button>

            <a href="login.php?action=recuperar" class="link-olvidaste-contrasena">¿Olvidaste tu contraseña?</a>
        </form>

        <div class="link-registro">
            ¿No tienes una cuenta? <a href="../registrarse.php">Regístrate aquí</a>
        </div>
    </div>
</main>

<?php
include_once("./views/login/footer.php");
?>
