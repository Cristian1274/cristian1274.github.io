<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

unset($_SESSION['carrito']);

// Redireccionar al usuario a la página de inicio de sesión
header("Location: index.php");

exit;
?>