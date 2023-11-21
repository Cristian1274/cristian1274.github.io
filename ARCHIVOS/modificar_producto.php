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

// Verificar si se ha proporcionado el parámetro id_producto
if (isset($_GET["id"])) {
  $idProducto = $_GET["id"];

  // Obtener los datos del producto a modificar
  $sql = "SELECT * FROM producto WHERE id_producto = '$idProducto'";
  $resultado = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);

    // Mostrar el formulario para modificar el producto
?>
<!DOCTYPE html>
<html>
<head>
  <title>Modificar Producto</title>
  <link rel="stylesheet" href="inelmo.css">
</head>
<body>
  <div class="container">
    <h1>Modificar Producto</h1>
    <form method="POST" action="guardar_modificacion_producto.php" enctype="multipart/form-data">
      <input type="hidden" name="id_producto" value="<?php echo $fila["id_producto"]; ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" value="<?php echo $fila["Nombre"]; ?>" required>
      <br>
      <label for="precio">Precio:</label>
      <input type="number" name="precio" id="precio" value="<?php echo $fila["Precio"]; ?>" required>
      <br>
      <label for="cantidad_dispo">Cantidad Disponible:</label>
      <input type="number" name="cantidad_dispo" id="cantidad_dispo" value="<?php echo $fila["Cantidad_dispo"]; ?>" required>
      <br>
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" required><?php echo $fila["descripcion"]; ?></textarea>
      <br>
      <label for="id_categoria">Categoría:</label>
      <select name="id_categoria" id="id_categoria" required>
        <?php
        // Obtener las opciones de categoría
        $categorias = mysqli_query($conn, "SELECT * FROM categoria");
        while ($categoria = mysqli_fetch_assoc($categorias)) {
          $selected = ($categoria["id_categoria"] == $fila["id_categoria"]) ? "selected" : "";
          echo '<option value="' . $categoria["id_categoria"] . '" ' . $selected . '>' . $categoria["Nombre_categoria"] . '</option>';
        }
        ?>
      </select>
      <br>
      <label for="id_marca">Marca:</label>
      <select name="id_marca" id="id_marca" required>
        <?php
        // Obtener las opciones de marca
        $marcas = mysqli_query($conn, "SELECT * FROM marca");
        while ($marca = mysqli_fetch_assoc($marcas)) {
          $selected = ($marca["id_marca"] == $fila["id_marca"]) ? "selected" : "";
          echo '<option value="' . $marca["id_marca"] . '" ' . $selected . '>' . $marca["Nombre_Marca"] . '</option>';
        }
        ?>
      </select>
      <br>
      <label for="id_talla">Talla:</label>
      <select name="id_talla" id="id_talla" required>
        <?php
        // Obtener las opciones de talla
        $tallas = mysqli_query($conn, "SELECT * FROM talla");
        while ($talla = mysqli_fetch_assoc($tallas)) {
          $selected = ($talla["id_talla"] == $fila["id_talla"]) ? "selected" : "";
          echo '<option value="' . $talla["id_talla"] . '" ' . $selected . '>' . $talla["nombre_talla"] . '</option>';
        }
        ?>
      </select>
      <br>
      <label for="id_proveedor">Proveedor:</label>
      <select name="id_proveedor" id="id_proveedor" required>
        <?php
        // Obtener las opciones de proveedor
        $proveedores = mysqli_query($conn, "SELECT * FROM proveedor");
        while ($proveedor = mysqli_fetch_assoc($proveedores)) {
          $selected = ($proveedor["id_proveedor"] == $fila["id_proveedor"]) ? "selected" : "";
          echo '<option value="' . $proveedor["id_proveedor"] . '" ' . $selected . '>' . $proveedor["Nombre_proveedor"] . '</option>';
        }
        ?>
      </select>
      <br>
      <label for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen">
      <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
<?php
  } else {
    echo "No se encontró el producto";
  }
}

mysqli_close($conn);
?>


