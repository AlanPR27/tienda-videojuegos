<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">
    <div class="container-box">
        <h2>Inicio de sesión</h2>

        <form action="validar_login.php" method="post">
            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control">
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>