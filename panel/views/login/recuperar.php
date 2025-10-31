<?php
include_once("./views/login/header.php");
?>

<form action="login.php?action=cambio" method="POST">

    <div class="mb-3 row">

    <label for="staticEmail" class="col-sm-2 col-form-label">Correo</label>
    <div class="col-sm-10">
        <input name = "correo" type="text" class="form-control" id="correo">
    </div>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Recuperar">
    </div>

    </div>
</form>

<?php
include_once("./views/login/footer.php");
?>
