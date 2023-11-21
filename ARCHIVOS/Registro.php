<?php
// Recuperar los valores del formulario

$Nombre_Cliente = $_POST['Nombre_Cliente'];
$APP_Cliente = $_POST['APP_Cliente'];
$APM_Cliente = $_POST['APM_Cliente'];
$Correo_Electronico = $_POST['Correo_Electronico'];
$password = $_POST['password'];
$Id_Rol = 3;

// Conectarse a la base de datos
$conexion = mysqli_connect("localhost", "root","", "j5");

// Verificar si se pudo establecer la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Insertar los datos en la tabla de clientes
$sql = "INSERT INTO cliente (Nombre_Cliente, APP_Cliente, APM_Cliente, Correo_Electronico, password, Id_Rol) VALUES ('$Nombre_Cliente', '$APP_Cliente', '$APM_Cliente', '$Correo_Electronico', '$password', '$Id_Rol')";
if (mysqli_query($conexion, $sql)) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar el cliente: " . mysqli_error($conexion);
}

// Cerrar la conexión
