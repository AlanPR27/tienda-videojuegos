<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT productos.*, categorias.nombre AS categoria, plataformas.nombre AS plataforma
        FROM productos
        INNER JOIN categorias ON productos.id_categoria = categorias.id
        INNER JOIN plataformas ON productos.id_plataforma = plataformas.id";

$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Tienda Alan</title>
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
        <h2 class="mb-4 text-center">Catálogo de Productos</h2>

        <div class="row">
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<div class='col-md-4 col-sm-6 mb-4'>";
                    echo "<div class='card h-100 p-3'>";
                        if ($fila["imagen"] != "") {
                            echo "<img src='img/" . $fila["imagen"] . "' class='card-img-top mb-3' style='height:200px;object-fit:contain;background:#0f172a;' alt='" . $fila["nombre"] . "'>";
                        } else {
                            echo "<div class='card-img-top mb-3' style='height:200px;background:#0f172a;display:flex;align-items:center;justify-content:center;'>Sin imagen</div>";
                        }
                        echo "<h4>" . $fila["nombre"] . "</h4>";
                        echo "<p><strong>Categoría:</strong> " . $fila["categoria"] . "</p>";
                        echo "<p><strong>Plataforma:</strong> " . $fila["plataforma"] . "</p>";
                        echo "<p>" . $fila["descripcion"] . "</p>";
                        echo "<p><strong>Fabricante:</strong> " . $fila["fabricante"] . "</p>";
                        echo "<p><strong>Origen:</strong> " . $fila["origen"] . "</p>";
                        echo "<p><strong>Stock:</strong> " . $fila["stock"] . "</p>";
                        echo "<h5>$" . $fila["precio"] . "</h5>";

                        if ($fila["stock"] > 0) {
                            echo "<form action='agregar_carrito.php' method='post'>";
                                echo "<input type='hidden' name='id_producto' value='" . $fila["id"] . "'>";
                                echo "<label>Cantidad</label>";
                                echo "<input type='number' name='cantidad' value='1' min='1' max='" . $fila["stock"] . "' class='form-control mb-3'>";
                                echo "<button type='submit' class='btn btn-primary w-100'>Agregar al carrito</button>";
                            echo "</form>";
                        } else {
                            echo "<button class='btn btn-secondary w-100' disabled>Sin stock</button>";
                        }
                    echo "</div>";
                echo "</div>";
            }

            mysqli_close($conexion);
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
