<?php
require 'privado/modelo.php';

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de autenticación</title>
</head>
<body>
    <header>
        <h1>Sistema de autenticación</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <?php
            if(isset($_SESSION['usuario'])){
                echo "<li><a href='privado/pagina_privada.php'>Página privada</a></li>";
                echo "<li><a href='privado/tienda.php'>Tienda</a></li>";
                echo "<li><a href='privado/carrito.php'>Carrito (" . totalProductos() . ")</a></li>";                
                echo "<li><a href='privado/logout.php'>Cerrar sesión</a></li>";
            }else{
                echo "<li><a href='./login.php'>Iniciar sesion</a></li>";
                echo "<li><a href='./registro.php'>Registrate</a></li>";
            }

            ?>
           
        </ul>
    </nav>

    <main>
        <section>
            <article>
                <h1>Página inicial</h1>
                <p>
                    Esta es la página principal de la web de ejemplo con un sistema de autenticación
                    de usuarios con PHP.
                </p>
            </article>
        </section>
    </main>

    <footer>
    <small>&copy; Laura López 2DAW</small>
    </footer>
</body>
</html>
