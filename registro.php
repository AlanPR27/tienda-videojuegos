<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">
    <div class="container-box">
        <h2>Crear cuenta</h2>

        <form action="guardar_usuario.php" method="post">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control">
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control">
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
            </div>

            <div class="mb-3">
                <label>Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control">
            </div>

            <div class="mb-3">
                <label>Número de tarjeta</label>
                <input type="text" name="tarjeta" class="form-control">
            </div>

            <div class="mb-3">
                <label>Dirección postal</label>
                <input type="text" name="direccion" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Crear cuenta</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>