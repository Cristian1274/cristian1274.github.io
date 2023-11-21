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
  $nombreCategoria = $_POST["nombre_categoria"];
  $descripcionCategoria = $_POST["descripcion_categoria"];

  // Insertar los valores en la tabla categoria
  $sql = "INSERT INTO categoria (Nombre_Categoria, Descripcion)
          VALUES ('$nombreCategoria', '$descripcionCategoria')";

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
  <title>Insertar Categoría</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Categoría</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="nombre_categoria">Nombre de la Categoría:</label>
      <input type="text" name="nombre_categoria" id="nombre_categoria" required>
      <br>
      <label for="descripcion_categoria">Descripción de la Categoría:</label>
      <input type="text" name="descripcion_categoria" id="descripcion_categoria" required>
      <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
