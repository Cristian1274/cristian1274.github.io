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
if (isset($_POST['id_proveedor']) && isset($_POST['nombre_proveedor']) && isset($_POST['direccion']) && isset($_POST['correo_electronico']) && isset($_POST['telefono'])) {
  $idProveedor = $_POST['id_proveedor'];
  $nombreProveedor = $_POST['nombre_proveedor'];
  $direccion = $_POST['direccion'];
  $correoElectronico = $_POST['correo_electronico'];
  $telefono = $_POST['telefono'];

  // Actualizar el registro en la base de datos
  $sql = "UPDATE proveedor SET Nombre_proveedor = '$nombreProveedor', Direccion = '$direccion', Correo_Electronico = '$correoElectronico', Telefono = '$telefono' WHERE id_proveedor = '$idProveedor'";
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
