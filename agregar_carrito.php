<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_usuario"])) {
    echo "<script>alert('Primero inicia sesión'); window.location='login.php';</script>";
    exit();
}

$id_usuario = $_SESSION["id_usuario"];
$id_producto = $_POST["id_producto"];
$cantidad = $_POST["cantidad"];

$sql_carrito = "SELECT id FROM carrito WHERE id_usuario = $id_usuario";
$resultado_carrito = mysqli_query($conexion, $sql_carrito);

if (mysqli_num_rows($resultado_carrito) > 0) {
    $carrito = mysqli_fetch_assoc($resultado_carrito);
    $id_carrito = $carrito["id"];
} else {
    $sql_crear = "INSERT INTO carrito (id_usuario) VALUES ($id_usuario)";
    mysqli_query($conexion, $sql_crear);
    $id_carrito = mysqli_insert_id($conexion);
}

$sql_producto = "SELECT * FROM carrito_detalle 
                 WHERE id_carrito = $id_carrito AND id_producto = $id_producto";

$resultado_producto = mysqli_query($conexion, $sql_producto);

if (mysqli_num_rows($resultado_producto) > 0) {
    $sql = "UPDATE carrito_detalle 
            SET cantidad = cantidad + $cantidad 
            WHERE id_carrito = $id_carrito AND id_producto = $id_producto";
} else {
    $sql = "INSERT INTO carrito_detalle (id_carrito, id_producto, cantidad)
            VALUES ($id_carrito, $id_producto, $cantidad)";
}

mysqli_query($conexion, $sql);

echo "<script>alert('Producto agregado al carrito'); window.location='catalogo.php';</script>";
?>