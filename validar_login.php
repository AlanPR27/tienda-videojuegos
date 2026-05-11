<?php
session_start();

$conexion = mysqli_connect("db", "root", "root_password", "tienda_videojuegos");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];

if ($correo == "" || $contrasena == "") {
    echo "<script>
        alert('Ingrese correo y contraseña');
        window.location='login.php';
    </script>";
    exit();
}

$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    if ($contrasena == $usuario["contrasena"]) {
        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["nombre_usuario"] = $usuario["nombre"];

        echo "<script>
            alert('Sesión iniciada correctamente');
            window.location='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Contraseña incorrecta');
            window.location='login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('El correo no existe');
        window.location='login.php';
    </script>";
}

mysqli_close($conexion);
?>
