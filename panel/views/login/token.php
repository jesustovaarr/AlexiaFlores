<?php
include_once("./views/login/header.php");
?>

<main class="contenedor-login">
    <div class="form-login">
        <div class="header-login">
            <a href="../index.php" class="logo-login">Arreglos Alexia Flores</a>
            <p>Ingresa tu nueva contraseña.</p>
        </div>

        <form action="login.php?action=restablecer" method="POST">
            <input type="hidden" name="token" id="token" value="<?php echo $_GET['token']; ?>">
            <input type="hidden" name="correo" id="correo" value="<?php echo $_GET['correo']; ?>">

            <div class="form-floating mb-3">
                <input name="contrasena" type="password" class="form-control" id="contrasena" placeholder="Nueva Contraseña" required>
                <label for="contrasena">Nueva Contraseña</label>
            </div>

            <div class="form-floating mb-4">
                <input name="contrasena_confirmar" type="password" class="form-control" id="contrasena_confirmar" placeholder="Confirmar Nueva Contraseña" required>
                <label for="contrasena_confirmar">Confirmar Nueva Contraseña</label>
            </div>

            <button type="submit" name="enviar" class="btn btn-login">Restablecer Contraseña</button>
        </form>
    </div>
</main>

<?php
include_once("./views/login/footer.php");
?>

