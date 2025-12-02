<?php 
include_once("./views/login/header.php");

if (isset($alerta['mensaje']) && isset($alerta['tipo'])): ?>
<div class="alert alert-<?php echo $alerta['tipo']; ?> text-center alerta-recortada" role="alert">
    <h4 class="alert-heading">Acceso Denegado</h4>
    <p><?php echo $alerta['mensaje']; ?></p>
    <hr>
    <a href="../index.php" class="btn btn-primary">Volver al inicio</a>
</div>
<?php endif;
include_once("./views/login/footer.php");
?>
