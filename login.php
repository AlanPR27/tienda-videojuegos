<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Tienda Alan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Tienda Alan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Inicio</a>
                <a class="nav-link" href="catalogo.php">Catálogo</a>
                <a class="nav-link" href="carrito.php">Carrito</a>
                <a class="nav-link" href="admin.php">Admin</a>
                <?php
                if (isset($_SESSION["id_usuario"])) {
                    echo "<span class='navbar-text text-white me-3'>Hola, " . $_SESSION["nombre_usuario"] . "</span>";
                    echo "<a class='nav-link' href='logout.php'>Cerrar sesión</a>";
                } else {
                    echo "<a class='nav-link' href='login.php'>Login</a>";
                    echo "<a class='nav-link' href='registro.php'>Registro</a>";
                }
                ?>
            </div>
        </div>
    </div>
</nav>

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
