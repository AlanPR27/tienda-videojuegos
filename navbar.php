

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