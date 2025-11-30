<?php
if (isset($_SESSION['alerta'])) {
    echo '<div class="alert alert-' . $_SESSION['alerta']['tipo'] . ' text-center alerta-recortada" role="alert">' . $_SESSION['alerta']['mensaje'] . '</div>';
    unset($_SESSION['alerta']);
}
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="form-login">
                <div class="header-login">
                    <a href="index.php" class="logo-login">Arreglos Alexia Flores</a>
                    <p>Crea tu cuenta para empezar.</p>
                </div>

                <form action="registrarse.php" method="POST" class="mt-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="primer_apellido" class="form-label">Primer Apellido*</label>
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo Apellido*</label>
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico*</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contrasena" class="form-label">Contraseña*</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña*</label>
                            <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento*</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="id_genero" class="form-label">Género*</label>
                        <select class="form-select" id="id_genero" name="id_genero" required>
                            <option value="" disabled selected>Selecciona tu género</option>
                            <?php foreach ($data['generos'] as $genero): ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-login">Registrarse</button>
                </form>

                <div class="link-registro">
                    ¿Ya tienes una cuenta? <a href="panel/login.php">Inicia Sesión</a>
                </div>
            </div>
        </div>
    </div>
</main>
