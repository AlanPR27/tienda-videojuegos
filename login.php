<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">
    <div class="container-box">
        <h2>Inicio de Sesión</h2>

        <form>
            <div class="mb-3">
                <label>Correo</label>
                <input type="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" class="form-control">
            </div>

            <button class="btn btn-primary">Ingresar</button>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>