<?php
session_start();
include("conexion.php");

$id = $_GET["id"];

$sql = "DELETE FROM carrito_detalle WHERE id = $id";
mysqli_query($conexion, $sql);

echo "<script>alert('Producto eliminado del carrito'); window.location='carrito.php';</script>";
?>