<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$mensaje = "";

// Procesar acciones del admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];

    if ($accion == "agregar") {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $fabricante = $_POST["fabricante"];
        $origen = $_POST["origen"];
        $id_categoria = $_POST["id_categoria"];
        $id_plataforma = $_POST["id_plataforma"];
        $imagen = $_POST["imagen"];

        if ($nombre == "" || $precio == "" || $stock == "") {
            $mensaje = "Faltan campos obligatorios";
        } else {
            $sql = "INSERT INTO productos (id_categoria, id_plataforma, nombre, descripcion, imagen, precio, stock, fabricante, origen)
                    VALUES ($id_categoria, $id_plataforma, '$nombre', '$descripcion', '$imagen', $precio, $stock, '$fabricante', '$origen')";

            if (mysqli_query($conexion, $sql)) {
                $mensaje = "Producto agregado correctamente";
            } else {
                $mensaje = "Error al agregar: " . mysqli_error($conexion);
            }
        }
    }

    if ($accion == "modificar") {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $imagen = $_POST["imagen"];

        $sql = "UPDATE productos
                SET nombre = '$nombre',
                    descripcion = '$descripcion',
                    precio = $precio,
                    stock = $stock,
                    imagen = '$imagen'
                WHERE id = $id";

        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Producto modificado correctamente";
        } else {
            $mensaje = "Error al modificar: " . mysqli_error($conexion);
        }
    }
}

// Cargar datos para mostrar
$categorias = mysqli_query($conexion, "SELECT * FROM categorias");
$plataformas = mysqli_query($conexion, "SELECT * FROM plataformas");
$productos = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id");
$compras = mysqli_query($conexion,
    "SELECT compras.id, compras.fecha, compras.total, usuarios.nombre AS usuario
     FROM compras
     INNER JOIN usuarios ON compras.id_usuario = usuarios.id
     ORDER BY compras.fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tienda Alan</title>
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
        <h2 class="mb-4">Panel de Administración</h2>

        <?php
        if ($mensaje != "") {
            echo "<div class='alert alert-info'>" . $mensaje . "</div>";
        }
        ?>

        <!-- AGREGAR PRODUCTO -->
        <h3 class="mt-4">Agregar nuevo producto</h3>
        <form action="admin.php" method="post" class="mb-5">
            <input type="hidden" name="accion" value="agregar">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01" min="0" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" min="0" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Categoría</label>
                    <select name="id_categoria" class="form-control">
                        <?php
                        while ($cat = mysqli_fetch_assoc($categorias)) {
                            echo "<option value='" . $cat["id"] . "'>" . $cat["nombre"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Plataforma</label>
                    <select name="id_plataforma" class="form-control">
                        <?php
                        while ($plat = mysqli_fetch_assoc($plataformas)) {
                            echo "<option value='" . $plat["id"] . "'>" . $plat["nombre"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Fabricante</label>
                    <input type="text" name="fabricante" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Origen</label>
                    <input type="text" name="origen" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Nombre archivo de imagen</label>
                    <input type="text" name="imagen" placeholder="ejemplo.jpg" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Agregar producto</button>
        </form>

        <hr>

        <!-- MODIFICAR PRODUCTOS EXISTENTES -->
        <h3 class="mt-4">Modificar productos existentes</h3>
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($prod = mysqli_fetch_assoc($productos)) {
                    echo "<tr>";
                    echo "<form action='admin.php' method='post'>";
                    echo "<input type='hidden' name='accion' value='modificar'>";
                    echo "<input type='hidden' name='id' value='" . $prod["id"] . "'>";
                    echo "<td>" . $prod["id"] . "</td>";
                    echo "<td><input type='text' name='nombre' value='" . $prod["nombre"] . "' class='form-control'></td>";
                    echo "<td><input type='text' name='descripcion' value='" . $prod["descripcion"] . "' class='form-control'></td>";
                    echo "<td><input type='number' name='precio' step='0.01' value='" . $prod["precio"] . "' class='form-control' style='width:110px;'></td>";
                    echo "<td><input type='number' name='stock' value='" . $prod["stock"] . "' class='form-control' style='width:90px;'></td>";
                    echo "<td><input type='text' name='imagen' value='" . $prod["imagen"] . "' class='form-control' style='width:160px;'></td>";
                    echo "<td><button type='submit' class='btn btn-sm btn-primary'>Guardar</button></td>";
                    echo "</form>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <hr>

        <!-- HISTORIAL DE COMPRAS -->
        <h3 class="mt-4">Historial de compras</h3>

        <?php
        if (mysqli_num_rows($compras) == 0) {
            echo "<p>Aún no hay compras registradas.</p>";
        } else {
            echo "<table class='table table-dark table-striped'>";
            echo "<thead><tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Productos</th>
                  </tr></thead><tbody>";

            while ($compra = mysqli_fetch_assoc($compras)) {
                $id_compra = $compra["id"];

                $sql_detalle = "SELECT compra_detalle.cantidad, compra_detalle.precio, productos.nombre
                                FROM compra_detalle
                                INNER JOIN productos ON compra_detalle.id_producto = productos.id
                                WHERE compra_detalle.id_compra = $id_compra";
                $detalle = mysqli_query($conexion, $sql_detalle);

                echo "<tr>";
                echo "<td>" . $compra["id"] . "</td>";
                echo "<td>" . $compra["usuario"] . "</td>";
                echo "<td>" . $compra["fecha"] . "</td>";
                echo "<td>$" . number_format($compra["total"], 2) . "</td>";
                echo "<td>";
                    echo "<ul class='mb-0'>";
                    while ($d = mysqli_fetch_assoc($detalle)) {
                        echo "<li>" . $d["cantidad"] . " x " . $d["nombre"] . " ($" . $d["precio"] . " c/u)</li>";
                    }
                    echo "</ul>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        }

        mysqli_close($conexion);
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
