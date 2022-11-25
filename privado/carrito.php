<?php
require 'modelo.php';

session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <header>
        <h1>Carrito</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pagina_publica.php">Página pública</a></li>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo "<li><a href='./pagina_privada.php'>Página privada</a></li>";
                echo "<li><a href='./tienda.php'>Tienda</a></li>";
                echo "<li><a href='./logout.php'>Cerrar sesión</a></li>";
            } else {
                echo "<li><a href='./login.php'>Iniciar sesion</a></li>";
                echo "<li><a href='./registro.php'>Registrate</a></li>";
            }

            ?>

        </ul>
    </nav>

    <main>
        <section>
            <h1>Cesta de la compra</h1>

            <?php
            if ($_SESSION) {
                echo "<ul>";
                foreach ($_SESSION as $producto => $cantidad) {
                    if ($producto != "usuario") {
                        echo <<<END
                            <li>$producto: $cantidad</li>
                        END;
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>No hay productos en el carrito de la compra</p>";
            }
            ?>
        </section>
    </main>

    <footer>
        <small><em>&copy; Laura López 2DAW</em></small>
    </footer>
</body>

</html>