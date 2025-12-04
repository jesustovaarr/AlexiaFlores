<?php if (isset($_SESSION['alerta']['mensaje']) && isset($_SESSION['alerta']['tipo'])): ?>
<div class="alert alert-<?php echo $_SESSION['alerta']['tipo']; ?>" role="alert">
    <?php echo $_SESSION['alerta']['mensaje']; ?>
</div>
<?php unset($_SESSION['alerta']); endif; ?>
