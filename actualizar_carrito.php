<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (!isset($_SESSION["id_usuario"])) {
    echo "<script>alert('Primero inicia sesión'); window.location='login.php';</script>";
    exit();
}

$id = $_POST["id"];
$cantidad = $_POST["cantidad"];

if ($cantidad < 1) {
    echo "<script>alert('La cantidad debe ser mayor a 0'); window.location='carrito.php';</script>";
    exit();
}

$sql = "UPDATE carrito_detalle SET cantidad = $cantidad WHERE id = $id";
mysqli_query($conexion, $sql);

mysqli_close($conexion);

echo "<script>alert('Carrito actualizado'); window.location='carrito.php';</script>";
?>
