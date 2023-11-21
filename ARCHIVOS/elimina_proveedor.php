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

  // Obtener los detalles del proveedor
  $sql = "SELECT Nombre_proveedor FROM proveedor WHERE id_proveedor = '$idProveedor'";
  $resultado = mysqli_query($conn, $sql);
  $fila = mysqli_fetch_assoc($resultado);
  $nombreProveedor = $fila["Nombre_proveedor"];

  // Mostrar mensaje de confirmación
  echo "<script>";
  echo "var confirmacion = confirm('¿Estás seguro/a de que deseas eliminar el proveedor: $nombreProveedor?');";
  echo "if (confirmacion) {";
  echo "  window.location.href = 'eliminar_proveedor.php?id=$idProveedor';";
  echo "} else {";
  echo "  window.location.href = 'Administrador.html';";
  echo "}";
  echo "</script>";
}

mysqli_close($conn);
?>
