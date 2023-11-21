<?php
session_start(); // Iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Actualizar la cantidad en el carrito de la sesión
    $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;

    // Redirigir de vuelta al carrito
    header('Location: carrito.php');
    exit();
}
?>
