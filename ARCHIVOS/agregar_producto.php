<?php
$conexion = mysqli_connect('localhost', 'root', '', 'j5');

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['id_categoria'];
$id_marca = $_POST['id_marca'];
$id_talla = $_POST['id_talla'];
$id_proveedor = $_POST['id_proveedor'];

// Guardar la imagen en una carpeta
$imagen = $_FILES['imagen']['name']; // Nombre del archivo
$imagen_temporal = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo

// Directorio donde se almacenarán las imágenes
$directorio_destino = 'imagenes/';

// Ruta completa del archivo de imagen
$ruta_imagen = $directorio_destino . $imagen;

// Mover la imagen desde la ruta temporal al directorio destino
if (move_uploaded_file($imagen_temporal, $ruta_imagen)) {
  // La imagen se ha movido correctamente

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

  // Preparar la consulta SQL para insertar el producto con la imagen
  $sql = "INSERT INTO producto (Nombre, Precio, Cantidad_dispo, descripcion, id_categoria, id_marca, id_talla, id_proveedor, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  
  // Vincular los parámetros de la consulta
  mysqli_stmt_bind_param($stmt, "siiisiiis", $nombre, $precio, $cantidad, $descripcion, $id_categoria, $id_marca, $id_talla, $id_proveedor, $imagen);

  // Ejecutar la consulta
  if (mysqli_stmt_execute($stmt)) {
    // El producto se ha insertado correctamente en la base de datos
    echo "El producto se ha agregado correctamente.";
  } else {
    // Ocurrió un error al insertar el producto
    echo "Error al agregar el producto: " . mysqli_error($conn);
  }

  // Cerrar la conexión
  mysqli_close($conn);
} else {
  // Ocurrió un error al mover la imagen
  echo "Error al subir la imagen.";
}
?>