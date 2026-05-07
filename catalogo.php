<?php
session_start();
include("conexion.php");

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
    <title>Catálogo - GameStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">

    <div class="container-box">

        <h2 class="mb-4 text-center">Catálogo de Productos 🎮</h2>

        <div class="row">

            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {

                echo "<div class='col-md-4 mb-4'>";

                    echo "<div class='card h-100 p-3'>";

                        echo "<h4>" . $fila["nombre"] . "</h4>";

                        echo "<p><strong>Categoría:</strong> " . $fila["categoria"] . "</p>";

                        echo "<p><strong>Plataforma:</strong> " . $fila["plataforma"] . "</p>";

                        echo "<p>" . $fila["descripcion"] . "</p>";

                        echo "<p><strong>Fabricante:</strong> " . $fila["fabricante"] . "</p>";

                        echo "<p><strong>Origen:</strong> " . $fila["origen"] . "</p>";

                        echo "<p><strong>Stock:</strong> " . $fila["stock"] . "</p>";

                        echo "<h5>$" . $fila["precio"] . "</h5>";

                        // FORMULARIO PARA AGREGAR AL CARRITO
                        echo "<form action='agregar_carrito.php' method='post'>";

                            // ID DEL PRODUCTO
                            echo "<input type='hidden' 
                                         name='id_producto' 
                                         value='" . $fila["id"] . "'>";

                            // CANTIDAD
                            echo "<label>Cantidad</label>";

                            echo "<input type='number' 
                                         name='cantidad' 
                                         value='1' 
                                         min='1' 
                                         max='" . $fila["stock"] . "'
                                         class='form-control mb-3'>";

                            // BOTÓN
                            echo "<button type='submit' 
                                          class='btn btn-primary w-100'>
                                          Agregar al carrito
                                  </button>";

                        echo "</form>";

                    echo "</div>";

                echo "</div>";
            }
            ?>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>