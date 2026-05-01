<?php
$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>