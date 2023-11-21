<?php
// Conectar a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "j5";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificar la conexión
if (!$conn) {
  die("La conexión falló: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los valores del formulario
  $nombreCliente = $_POST["nombre_cliente"];
  $apellidoPaterno = $_POST["apellido_paterno"];
  $apellidoMaterno = $_POST["apellido_materno"];
  $correoElectronico = $_POST["correo_electronico"];
  $password = $_POST["password"];
  $idRol = 3; // Valor predeterminado para el rol

  // Insertar los valores en la tabla cliente
  $sql = "INSERT INTO cliente (Nombre_Cliente, APP_Cliente, APM_Cliente, Correo_Electronico, password, Id_Rol)
          VALUES ('$nombreCliente', '$apellidoPaterno', '$apellidoMaterno', '$correoElectronico', '$password', '$idRol')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>Registro insertado correctamente</script>";
    echo '<script>window.location.href = "Administrador.html";</script>'; // Redireccionar a la página deseada
  } else {
    echo "Error al insertar el registro: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insertar Cliente</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Cliente</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="nombre_cliente">Nombre del Cliente:</label>
      <input type="text" name="nombre_cliente" id="nombre_cliente" required>
      <br>
      <label for="apellido_paterno">Apellido Paterno:</label>
      <input type="text" name="apellido_paterno" id="apellido_paterno" required>
      <br>
      <label for="apellido_materno">Apellido Materno:</label>
      <input type="text" name="apellido_materno" id="apellido_materno" required>
      <br>
      <label for="correo_electronico">Correo Electrónico:</label>
      <input type="email" name="correo_electronico" id="correo_electronico" required>
      <br>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" id="password" required>
      <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
