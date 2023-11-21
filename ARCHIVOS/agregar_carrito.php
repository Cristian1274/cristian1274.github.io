<?php
session_start();

// Obtener los datos del producto seleccionado
$id_producto = $_GET['id_producto'];
$nombre = $_GET['nombre'];
$precio = $_GET['precio'];
$talla = $_GET['id_talla']; // Corregir el nombre del campo de la talla
$cantidad = $_GET['cantidad'];
$rutaImagen = $_GET['foto'];

// Verificar si el producto ya está en el carrito
if (isset($_SESSION['carrito'][$id_producto])) {
    // Incrementar la cantidad del producto en el carrito
    $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
} else {
    // Agregar el producto al carrito
    $_SESSION['carrito'][$id_producto] = array(
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'precio' => $precio,
        'talla' => $talla,
        'cantidad' => $cantidad,
        'foto' => $rutaImagen // Almacenar la ruta de la imagen en el carrito
    );
}

// Redireccionar al carrito de compras
header("Location: carrito.php");
exit();
?>
