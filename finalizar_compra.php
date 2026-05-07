<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_usuario"])) {
    echo "<script>alert('Primero inicia sesión'); window.location='login.php';</script>";
    exit();
}

$id_usuario = $_SESSION["id_usuario"];

$sql_carrito = "SELECT id FROM carrito WHERE id_usuario = $id_usuario";
$resultado_carrito = mysqli_query($conexion, $sql_carrito);

if (mysqli_num_rows($resultado_carrito) == 0) {
    echo "<script>alert('El carrito está vacío'); window.location='carrito.php';</script>";
    exit();
}

$carrito = mysqli_fetch_assoc($resultado_carrito);
$id_carrito = $carrito["id"];

$sql = "SELECT carrito_detalle.id_producto, carrito_detalle.cantidad, productos.precio, productos.stock
        FROM carrito_detalle
        INNER JOIN productos ON carrito_detalle.id_producto = productos.id
        WHERE carrito_detalle.id_carrito = $id_carrito";

$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 0) {
    echo "<script>alert('El carrito está vacío'); window.location='carrito.php';</script>";
    exit();
}

$total = 0;

while ($fila = mysqli_fetch_assoc($resultado)) {
    if ($fila["cantidad"] > $fila["stock"]) {
        echo "<script>alert('No hay suficiente stock para uno de los productos'); window.location='carrito.php';</script>";
        exit();
    }

    $total = $total + ($fila["cantidad"] * $fila["precio"]);
}

$sql_compra = "INSERT INTO compras (id_usuario, fecha, total)
               VALUES ($id_usuario, NOW(), $total)";

mysqli_query($conexion, $sql_compra);

$id_compra = mysqli_insert_id($conexion);

mysqli_data_seek($resultado, 0);

while ($fila = mysqli_fetch_assoc($resultado)) {
    $id_producto = $fila["id_producto"];
    $cantidad = $fila["cantidad"];
    $precio = $fila["precio"];

    $sql_detalle = "INSERT INTO compra_detalle (id_compra, id_producto, cantidad, precio)
                    VALUES ($id_compra, $id_producto, $cantidad, $precio)";
    mysqli_query($conexion, $sql_detalle);

    $sql_stock = "UPDATE productos 
                  SET stock = stock - $cantidad 
                  WHERE id = $id_producto";
    mysqli_query($conexion, $sql_stock);
}

$sql_vaciar = "DELETE FROM carrito_detalle WHERE id_carrito = $id_carrito";
mysqli_query($conexion, $sql_vaciar);

echo "<script>alert('Compra finalizada correctamente'); window.location='catalogo.php';</script>";
?>