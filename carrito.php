<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - Tienda Alan</title>
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
        <h2 class="mb-4">Carrito de Compras</h2>

        <?php
        if (!isset($_SESSION["id_usuario"])) {
            echo "<p>Debes <a href='login.php'>iniciar sesión</a> para ver tu carrito.</p>";
        } else {
            $id_usuario = $_SESSION["id_usuario"];

            $sql_carrito = "SELECT id FROM carrito WHERE id_usuario = $id_usuario";
            $resultado_carrito = mysqli_query($conexion, $sql_carrito);

            if (mysqli_num_rows($resultado_carrito) == 0) {
                echo "<p>No hay productos en el carrito.</p>";
            } else {
                $carrito = mysqli_fetch_assoc($resultado_carrito);
                $id_carrito = $carrito["id"];

                $sql = "SELECT carrito_detalle.id, carrito_detalle.cantidad,
                               productos.id AS id_producto, productos.nombre, productos.precio, productos.stock, productos.imagen
                        FROM carrito_detalle
                        INNER JOIN productos ON carrito_detalle.id_producto = productos.id
                        WHERE carrito_detalle.id_carrito = $id_carrito";

                $resultado = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($resultado) == 0) {
                    echo "<p>No hay productos en el carrito.</p>";
                } else {
                    $total = 0;

                    echo "<table class='table table-dark table-striped align-middle'>";
                    echo "<thead><tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                          </tr></thead><tbody>";

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $subtotal = $fila["cantidad"] * $fila["precio"];
                        $total = $total + $subtotal;

                        echo "<tr>";

                            echo "<td>";
                                if ($fila["imagen"] != "") {
                                    echo "<img src='img/" . $fila["imagen"] . "' style='width:60px;height:60px;object-fit:contain;margin-right:10px;'>";
                                }
                                echo $fila["nombre"];
                            echo "</td>";

                            echo "<td>$" . $fila["precio"] . "</td>";

                            echo "<td>";
                                echo "<form action='actualizar_carrito.php' method='post' class='d-flex'>";
                                    echo "<input type='hidden' name='id' value='" . $fila["id"] . "'>";
                                    echo "<input type='number' name='cantidad' value='" . $fila["cantidad"] . "' min='1' max='" . $fila["stock"] . "' class='form-control me-2' style='width:80px;'>";
                                    echo "<button type='submit' class='btn btn-sm btn-primary'>Actualizar</button>";
                                echo "</form>";
                            echo "</td>";

                            echo "<td>$" . number_format($subtotal, 2) . "</td>";

                            echo "<td><a href='eliminar_carrito.php?id=" . $fila["id"] . "' class='btn btn-sm btn-danger'>Eliminar</a></td>";

                        echo "</tr>";
                    }

                    echo "</tbody></table>";

                    echo "<h4 class='mt-4'>Total: $" . number_format($total, 2) . "</h4>";

                    echo "<a href='finalizar_compra.php' class='btn btn-success mt-3'>Finalizar compra</a>";
                    echo " <a href='catalogo.php' class='btn btn-outline-light mt-3'>Seguir comprando</a>";
                }
            }
        }

        mysqli_close($conexion);
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
