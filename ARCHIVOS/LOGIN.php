<?php
session_start(); // Iniciar la sesión

// ...

$servername = "localhost";
$username = "root";
$contrasena = "";
$dbname = "j5";

$conn = mysqli_connect($servername, $username, $contrasena, $dbname);

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Consulta SQL para buscar el usuario en la tabla Administrador
$query = "SELECT * FROM administrador WHERE Correo_Electronico = '$correo' AND password = '$contrasena'";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) == 1) {
    // Si se encontró al usuario en la tabla Administrador, se establece el rol correspondiente
    $_SESSION['loggedin'] = true;
    $_SESSION['Id_Rol'] = 1;
    header("Location: Administrador.html");
    exit;
} else {
    // Si no se encontró al usuario en la tabla Administrador, se realiza la misma consulta en la tabla Almacenista
    $query = "SELECT * FROM almacenista WHERE Correo_Electronico = '$correo' AND password = '$contrasena'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        // Si se encontró al usuario en la tabla Almacenista, se establece el rol correspondiente
        $_SESSION['loggedin'] = true;
        $_SESSION['Id_Rol'] = 2;
        header("Location: Almacenista.html");
        exit;
    } else {
        // Si no se encontró al usuario en ninguna de las tablas anteriores, se realiza la misma consulta en la tabla Cliente
        $query = "SELECT * FROM cliente WHERE Correo_Electronico = '$correo' AND password = '$contrasena'";
        $resultado = mysqli_query($conn, $query);

        if (mysqli_num_rows($resultado) == 1) {
            // Si se encontró al usuario en la tabla Cliente, se establece el rol correspondiente
            $_SESSION['loggedin'] = true;
            $_SESSION['Id_Rol'] = 3;
            $_SESSION['Correo_Electronico'] = $correo;
            header("Location: index.php");
            exit;
        } else {
            // Si no se encontró al usuario en ninguna de las tablas, el rol es inválido
            $error = "Rol no válido";
        }
    }
}

// ...
?>
