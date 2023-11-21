<?php
// Verificar la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j5";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Obtener las opciones de categoría
$categorias = mysqli_query($conn, "SELECT * FROM categoria");

// Obtener las opciones de marca
$marcas = mysqli_query($conn, "SELECT * FROM marca");

// Obtener las opciones de talla
$tallas = mysqli_query($conn, "SELECT * FROM talla");

// Obtener las opciones de proveedor
$proveedores = mysqli_query($conn, "SELECT * FROM proveedor");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los valores del formulario
  $nombreProducto = $_POST["nombre"];
  $precioProducto = $_POST["precio"];
  $cantidadProducto = $_POST["cantidad_dispo"];
  $descripcionProducto = $_POST["descripcion"];
  $categoriaProducto = $_POST["id_categoria"];
  $marcaProducto = $_POST["id_marca"];
  $tallaProducto = $_POST["id_talla"];
  $proveedorProducto = $_POST["id_proveedor"];

  // Verificar si se ha seleccionado una imagen
  if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
    // Obtener la información del archivo de imagen
    $imagenNombre = $_FILES["imagen"]["name"];

    // Mover el archivo de imagen a la ubicación deseada
    $rutaImagen = "imagenes/" . $imagenNombre;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen);

    // Insertar los datos del producto en la base de datos, incluyendo el nombre de la imagen
    $sql = "INSERT INTO producto (Nombre, Precio, Cantidad_dispo, descripcion, id_categoria, id_marca, id_talla, id_proveedor, foto) VALUES ('$nombreProducto', '$precioProducto', '$cantidadProducto', '$descripcionProducto', '$categoriaProducto', '$marcaProducto', '$tallaProducto', '$proveedorProducto', '$imagenNombre')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conn, $sql)) {
      echo "Producto insertado correctamente en la base de datos.";
    } else {
      echo "Error al insertar el producto: " . mysqli_error($conn);
    }
  } else {
    echo "Error al subir la imagen.";
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Insertar Producto</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Insertar Producto</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
      <label for="nombre">Nombre del Producto:</label>
      <input type="text" name="nombre" id="nombre" required>
      <br>
      <label for="precio">Precio:</label>
      <input type="text" name="precio" id="precio" required>
      <br>
      <label for="cantidad_dispo">Cantidad Disponible:</label>
      <input type="text" name="cantidad_dispo" id="cantidad_dispo" required>
<br>
<label for="descripcion">Descripción:</label>
<input type="text" name="descripcion" id="descripcion" required>
<br>
<label for="id_categoria">Categoría:</label>
<select name="id_categoria" id="id_categoria" required>
<?php while ($row = mysqli_fetch_assoc($categorias)) : ?>
<option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['Nombre_categoria']; ?></option>
<?php endwhile; ?>
</select>
<br>
<label for="id_marca">Marca:</label>
<select name="id_marca" id="id_marca" required>
<?php while ($row = mysqli_fetch_assoc($marcas)) : ?>
<option value="<?php echo $row['id_marca']; ?>"><?php echo $row['Nombre_Marca']; ?></option>
<?php endwhile; ?>
</select>
<br>
<label for="id_talla">Talla:</label>
<select name="id_talla" id="id_talla" required>
<?php while ($row = mysqli_fetch_assoc($tallas)) : ?>
<option value="<?php echo $row['id_talla']; ?>"><?php echo $row['nombre_talla']; ?></option>
<?php endwhile; ?>
</select>
<br>
<label for="id_proveedor">Proveedor:</label>
<select name="id_proveedor" id="id_proveedor" required>
<?php while ($row = mysqli_fetch_assoc($proveedores)) : ?>
<option value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['Nombre_proveedor']; ?></option>
<?php endwhile; ?>
</select>
<br>
<label for="imagen">Selecciona una imagen:</label>
<input type="file" name="imagen" id="imagen" accept="image/*" required>
<br>
<button type="submit">Guardar</button>
</form>

  </div>
</body>
</html>
