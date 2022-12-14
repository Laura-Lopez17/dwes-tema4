<?php
require 'modelo.php';

session_start();

if(!$_SESSION || !$_SESSION['usuario']) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No puedes acceder a esta página, <a href='../login.php'> inicia sesión </a>";
    exit();
}
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

    <ul>
            <li><strong>Home</strong></li>
            <li><a href="../pagina_publica.php">Página pública</a></li>
            <?php
            if(isset($_SESSION['usuario'])){
                echo "<li><a href='./tienda.php'>Tienda</a></li>";
                echo "<li><a href='./carrito.php'>Carrito (" . totalProductos() . ")</a></li>";                
                echo "<li><a href='./logout.php'>Cerrar sesión</a></li>";
            }else{
                echo "<li><a href='./login.php'>Iniciar sesion</a></li>";
                echo "<li><a href='./registro.php'>Registrate</a></li>";
            }

            ?>
           
        </ul>

    <main>
        <section>
            <article>
                <h1>Página privada</h1>
                <p>
                    Esta es la página privada, aquí solo debería acceder usuarios
                    registrados y que hayan iniciado sesión.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <small>&copy; Laura López 2DAW</small>
    </footer>
</body>
</html>