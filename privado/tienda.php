<?php
require 'modelo.php';

session_start();

$productoNuevo = [];

function productoValido($producto) {
    global $productos;

    $resultado = array_filter($productos, fn($p) => $p['id'] == $producto);

    if (count($resultado) == 1) {
        return $producto;
    } else {
        return false;
    }
}

if ($_POST) {
    $datos = [
        'producto' => htmlspecialchars(trim($_POST['producto'])),
        'cantidad' => htmlspecialchars(trim($_POST['cantidad']))
    ];

    $argumentos = [
        'producto' => [
            'filter' => FILTER_CALLBACK,
            'options' => 'productoValido'
        ],
        'cantidad' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ]
    ];

    $validaciones = filter_var_array($datos, $argumentos);

    if ($validaciones['producto'] !== false && $validaciones['cantidad'] !== false) {
        $producto = $datos['producto'];
        $cantidad = $datos['cantidad'];
        $_SESSION[$producto] = $cantidad;
        $productoNuevo[$producto] = $cantidad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <header>
        <h1>Tienda</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <?php
            if(isset($_SESSION['usuario'])){
                echo "<li><a href='pagina_privada.php'>Página privada</a></li>";
                echo "<li><a href='tienda.php'>Tienda</a></li>";
                echo "<li><a href='carrito.php'>Carrito (" . totalProductos() . ")</a></li>";                
                echo "<li><a href='privado/logout.php'>Cerrar sesión</a></li>";
            }else{
                echo "<li><a href='./login.php'>Iniciar sesion</a></li>";
                echo "<li><a href='./registro.php'>Registrate</a></li>";
            }

            ?>
           
        </ul>
    </nav>

    <main>
        <?php if ($productoNuevo) { ?>
        <section>
            <p>
                Se ha añadido un nuevo producto:
            </p>
            <p>
                <ul>
                    
                    <li><?= array_key_first($productoNuevo) . ": " . $productoNuevo[array_key_first($productoNuevo)] ?></li>
                </ul>
            </p>
        </section>
        <?php } ?>

        <section>
            <form action="" method="post">
                <p>
                    <label for="producto">Elige un producto</label>
                    <select name="producto" id="producto">
                        <?php 
                        foreach ($productos as $producto) {
                            echo "<option value='{$producto['id']}'>{$producto['valor']}</option>";
                            if (isset($validaciones) && $validaciones['producto'] === false) {
                                echo "<p>$producto no es una opción válida</p>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="cantidad">Elige la cantidad</label>
                    <input type="number" name="cantidad" id="cantidad">
                    <?php
                    if (isset($validaciones) && $validaciones['cantidad'] === false) {
                        echo "<p>{$datos['cantidad']} no es una cantidad válida, elige una cantidad mayor que 0</p>";
                    }
                    ?>
                </p>
                <p>
                    <input type="submit" value="Añadir al carrito">
                </p>
            </form>
        </section>
    </main>

    <footer>
    <small>&copy; Laura López 2DAW</small>
    </footer>
</body>
</html>
