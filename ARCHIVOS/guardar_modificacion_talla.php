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

// Verificar si se han enviado los datos del formulario
if (isset($_POST['Id_talla']) && isset($_POST['Nombre_talla']) ) {
  $idTalla = $_POST['Id_talla'];
  $NomTalla = $_POST['Nombre_talla'];
 

  // Actualizar el registro en la base de datos
  $sql = "UPDATE talla SET nombre_talla = '$NomTalla' WHERE id_talla = '$idTalla'";
  $resultado = mysqli_query($conn, $sql);

  if ($resultado) {
    // Mostrar mensaje de éxito en el centro de la pantalla
?>
<!DOCTYPE html>
<html>
<head>
  <title>Modificación Exitosa</title>
  <script>
    window.onload = function() {
      alert("Se ha modificado correctamente");
      window.location.href = "Administrador.html";
    };
  </script>
</head>
<body>
</body>
</html>
<?php
  } else {
    echo "Error al modificar el registro: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
