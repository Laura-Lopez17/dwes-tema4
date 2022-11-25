<?php
require 'privado/modelo.php';

session_start();

if (isset($_SESSION['usuario'])) {
    header('location: index.php');
    exit();
}

require 'lib/gestionUsuarios.php';

if($_POST) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    $esOk = loginUsuario($usuario,$clave);
    if ($esOk){
        $_SESSION['usuario'] = $usuario;
        header('location: index.php');
        exit();
    }

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

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <li><strong>Iniciar sesión</strong></li>
            <li><a href='registro.php'>Regístrate</a></li>
        </ul>
    </nav>

    <main>
        <h1>Inicia sesión</h1>

        <?php
        if ($_POST){
            echo "<p>ERROR: Usuario y/o contraseña no validos</p>";
        }
        ?>

        <form action="login.php" method="post">
            <p>
                <label for="usuario">Nombre de usuario</label><br>
                <input type="text" name="usuario" id="usuario" value="<?php echo $_POST && isset($_POST['usuario']) ? $_POST['usuario'] : '';?>">
            </p>
            <p>
                <label for="clave">Contraseña</label><br>
                <input type="password" name="clave" id="clave">
            </p>
            <p>
                <input type="submit" value="Inicia sesión">
            </p>
        </form>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>