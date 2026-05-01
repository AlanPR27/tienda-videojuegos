<?php
include("conexion.php");

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];
$fecha = $_POST["fecha_nacimiento"];
$tarjeta = $_POST["tarjeta"];
$direccion = $_POST["direccion"];

if ($nombre == "" || $correo == "" || $contrasena == "" || $fecha == "" || $tarjeta == "" || $direccion == "") {
    echo "<script>
        alert('Todos los campos son obligatorios');
        window.location='registro.php';
    </script>";
    exit();
}

$contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, correo, contrasena, fecha_nacimiento, tarjeta, direccion)
        VALUES ('$nombre', '$correo', '$contrasena_segura', '$fecha', '$tarjeta', '$direccion')";

if (mysqli_query($conexion, $sql)) {
    echo "<script>
        alert('Cuenta creada correctamente');
        window.location='login.php';
    </script>";
} else {
    echo "<script>
        alert('Error al crear cuenta. Puede que el correo ya exista.');
        window.location='registro.php';
    </script>";
}

mysqli_close($conexion);
?>