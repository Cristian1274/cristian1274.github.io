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
  $idMarca = $_GET["id"];

  // Eliminar el registro de la tabla marca
  $sql = "DELETE FROM marca WHERE id_marca = '$idMarca'";

  if (mysqli_query($conn, $sql)) {
    // Mostrar mensaje de eliminación exitosa utilizando JavaScript
    echo '<script>alert("Registro eliminado correctamente");</script>';
    echo '<script>window.location.href = "Administrador.html";</script>'; // Redireccionar a la página deseada
  } else {
    echo "Error al eliminar el registro: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
