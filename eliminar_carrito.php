<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$id = $_GET["id"];

$sql = "DELETE FROM carrito_detalle WHERE id = $id";
mysqli_query($conexion, $sql);

mysqli_close($conexion);

echo "<script>alert('Producto eliminado del carrito'); window.location='carrito.php';</script>";
?>
