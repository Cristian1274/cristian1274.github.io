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
  $nombreTalla = $_POST["nombre_talla"];

  // Insertar los valores en la tabla talla
  $sql = "INSERT INTO talla (nombre_talla)
          VALUES ('$nombreTalla')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>Registro insertado correctamente</script>";
    echo '<script>window.location.href = "tu_pagina.html";</script>'; // Redireccionar a la página deseada
  } else {
    echo "Error al insertar el registro: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insertar Talla</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Talla</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="nombre_talla">Nombre de la Talla:</label>
      <input type="text" name="nombre_talla" id="nombre_talla" required>
      <br>
      <button type="submit">Guardar</button>
</form>

  </div>
</body>
</html>
