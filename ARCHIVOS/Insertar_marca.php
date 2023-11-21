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
  $nombreMarca = $_POST["nombre_marca"];

  // Insertar los valores en la tabla marca
  $sql = "INSERT INTO marca (Nombre_Marca)
          VALUES ('$nombreMarca')";

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
  <title>Insertar Marca</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Marca</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="nombre_marca">Nombre de la Marca:</label>
      <input type="text" name="nombre_marca" id="nombre_marca" required>
      <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
