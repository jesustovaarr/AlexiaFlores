<?php
include_once("./views/login/header.php");
?>

<h1>Nueva Contraseña</h1>
<form action="login.php?action=restablecer" method="POST">


    <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
        <input name = "contrasena" type="password" class="form-control" id="contrasena">
    </div>

    <div class="mb-3">
        <input type="hidden" name="token" id="token" value="<?php echo $_GET['token']; ?>">
        <input type="hidden" name="correo" id="correo" value="<?php echo $_GET['correo']; ?>">
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Cambiar">
    </div>

    </div>
</form>

<?php
include_once("./views/login/footer.php");
?>
