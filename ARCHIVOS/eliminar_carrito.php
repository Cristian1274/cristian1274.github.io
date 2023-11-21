<?php
session_start(); // Iniciar la sesión para mantener los productos en el carrito

// Obtener el ID del producto a eliminar
$id_producto = $_GET['id_producto'];

// Verificar si el producto está en el carrito
if (isset($_SESSION['carrito'][$id_producto])) {
// Eliminar el producto del carrito
unset($_SESSION['carrito'][$id_producto]);
}

// Redireccionar al carrito de compras
header("Location: carrito.php");
exit();
?>