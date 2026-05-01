<?php
session_start();
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
        <h2 class="mb-3">Catálogo de Productos</h2>
        <p>Aquí se mostrarán los productos disponibles.</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Producto ejemplo</h5>
                    <p>Descripción breve</p>
                    <button class="btn btn-custom">Agregar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>