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
  $idProducto = $_POST["id_producto"];
  $nombreProducto = $_POST["nombre"];
  $precioProducto = $_POST["precio"];
  $cantidadProducto = $_POST["cantidad_dispo"];
  $descripcionProducto = $_POST["descripcion"];
  $categoriaProducto = $_POST["id_categoria"];
  $marcaProducto = $_POST["id_marca"];
  $tallaProducto = $_POST["id_talla"];
  $proveedorProducto = $_POST["id_proveedor"];

  // Actualizar los datos del producto en la base de datos
  $sql = "UPDATE producto SET Nombre = '$nombreProducto', Precio = '$precioProducto', Cantidad_dispo = '$cantidadProducto', descripcion = '$descripcionProducto', id_categoria = '$categoriaProducto', id_marca = '$marcaProducto', id_talla = '$tallaProducto', id_proveedor = '$proveedorProducto' WHERE id_producto = '$idProducto'";

  if (mysqli_query($conn, $sql)) {
    echo "Producto modificado correctamente en la base de datos.";
  } else {
    echo "Error al modificar el producto: " . mysqli_error($conn);
  }

  // Verificar si se ha proporcionado una nueva imagen
  if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
    // Obtener la información del archivo de imagen
    $imagenNombre = $_FILES["imagen"]["name"];

    // Mover el archivo de imagen a la ubicación deseada
    $rutaImagen = "imagenes/" . $imagenNombre;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen);

    // Actualizar el nombre de la imagen en la base de datos
    $sql = "UPDATE producto SET foto = '$imagenNombre' WHERE id_producto = '$idProducto'";

    if (mysqli_query($conn, $sql)) {
      echo "Imagen actualizada correctamente en la base de datos.";
    } else {
      echo "Error al actualizar la imagen: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
} else {
  echo "Método no permitido";
}
?>
