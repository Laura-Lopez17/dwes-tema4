<?php
$productos = [
    ['id' => 'pan', 'valor' => 'Pan'],
    ['id' => 'aceite', 'valor' => 'Aceite'],
    ['id' => 'platano', 'valor' => 'Plátano'],
    ['id' => 'arroz', 'valor' => 'Arroz'],
    ['id' => 'manzana', 'valor' => 'Manzana'],
    ['id' => 'pera', 'valor' => 'Pera'],
    ['id' => 'leche', 'valor' => 'Leche']


];

function totalProductos(): int {
    $numero = 0;
    if ($_SESSION) {
        foreach ($_SESSION as $cantidad) {
            $numero += intval($cantidad);
        }
    }
    return $numero;
}
