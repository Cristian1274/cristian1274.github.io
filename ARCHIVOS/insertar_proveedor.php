<?php
// Verificar la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j5";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los valores del formulario
  $nombreProveedor = $_POST["nombre"];
  $direccionProveedor = $_POST["direccion"];
  $correoProveedor = $_POST["correo"];
  $telefonoProveedor = $_POST["telefono"];

  // Insertar los datos del proveedor en la base de datos
  $sql = "INSERT INTO proveedor (Nombre_proveedor, Direccion, Correo_Electronico, Telefono) VALUES ('$nombreProveedor', '$direccionProveedor', '$correoProveedor', '$telefonoProveedor')";

  // Ejecutar la consulta SQL
  if (mysqli_query($conn, $sql)) {
    echo "Proveedor insertado correctamente en la base de datos.";
  } else {
    echo "Error al insertar el proveedor: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insertar Proveedor</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Proveedor</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="nombre">Nombre del Proveedor:</label>
      <input type="text" name="nombre" id="nombre" required>
      <br>
      <label for="direccion">Dirección:</label>
      <input type="text" name="direccion" id="direccion" required>
      <br>
      <label for="correo">Correo Electrónico:</label>
      <input type="email" name="correo" id="correo" required>
      <br>
      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" required>
      <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
