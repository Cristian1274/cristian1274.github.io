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

// Verificar si se ha proporcionado el parámetro id
if (isset($_GET["id"])) {
  $idCompra = $_GET["id"];

  // Obtener los datos del registro a modificar
  $sql = "SELECT * FROM talla WHERE id_talla = '$idCompra'";
  $resultado = mysqli_query($conn, $sql);
  

  if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);

    // Mostrar el formulario para modificar el registro
?>
<!DOCTYPE html>
<html>
<head>
  <title>Modificar Compra</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Modificar Compra</h1>
    <form method="POST" action="guardar_modificacion_talla.php">
      <input type="hidden" name="Id_talla" value="<?php echo $fila["id_talla"]; ?>">
      <label for="Nombre_talla">Nombre talla:</label>
      <input type="text" name="Nombre_talla" id="Nombre_talla" value="<?php echo $fila["nombre_talla"]; ?>" required>
      
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>

<?php
  } else {
    echo "No se encontró el registro";
  }
}

mysqli_close($conn);

?>
