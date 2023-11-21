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
  $idProveedor = $_GET["id"];

  // Obtener los datos del registro a modificar
  $sql = "SELECT * FROM proveedor WHERE id_proveedor = '$idProveedor'";
  $resultado = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);

    // Mostrar el formulario para modificar el registro
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Modificar Proveedor</title>
      <link rel="stylesheet" href="inelmo.css">
    </head>
    <body>
      <div class="container">
        <h1>Modificar Proveedor</h1>
        <form method="POST" action="guardar_modificacion_proveedor.php">
          <input type="hidden" name="id_proveedor" value="<?php echo $fila["id_proveedor"]; ?>">
          <label for="nombre_proveedor">Nombre Proveedor:</label>
          <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="<?php echo $fila["Nombre_proveedor"]; ?>" required>
          <br>
          <label for="direccion">Dirección:</label>
          <input type="text" name="direccion" id="direccion" value="<?php echo $fila["Direccion"]; ?>" required>
          <br>
          <label for="correo_electronico">Correo Electrónico:</label>
          <input type="email" name="correo_electronico" id="correo_electronico" value="<?php echo $fila["Correo_Electronico"]; ?>" required>
          <br>
          <label for="telefono">Teléfono:</label>
          <input type="text" name="telefono" id="telefono" value="<?php echo $fila["Telefono"]; ?>" required>
          <br>
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
