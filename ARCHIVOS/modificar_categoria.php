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
  $idCate = $_GET["id"];

  // Obtener los datos del registro a modificar
  $sql = "SELECT * FROM categoria WHERE id_categoria = '$idCate'";
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
    <form method="POST" action="guardar_modificacion_cate.php">
      <input type="hidden" name="Id_categoria" value="<?php echo $fila["id_categoria"]; ?>">
      <label for="nombre_categoria">Nombre categoria:</label>
      <input type="text" name="nombre_categoria" id="nombre_categoria" value="<?php echo $fila["Nombre_categoria"]; ?>" required>
      <br>
      <label for="descripcion">Fecha de Compra:</label>
      <input type="text" name="descripcion" id="descripcion" value="<?php echo $fila["Descripcion"]; ?>" required>
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
