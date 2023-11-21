<!DOCTYPE html>
<html>
<head>
  <title>Productos</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>PRODUCTOS</h1>
    <br>
    <form method="GET" action="consulta_producto.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_producto" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_producto') echo 'selected'; ?>>ID Producto</option>
          <option value="Nombre" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre') echo 'selected'; ?>>Nombre</option>
          <option value="Precio" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Precio') echo 'selected'; ?>>Precio</option>
          <option value="Cantidad_dispo" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Cantidad_dispo') echo 'selected'; ?>>Cantidad Disponible</option>
          <option value="descripcion" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'descripcion') echo 'selected'; ?>>Descripción</option>
          <option value="Nombre_categoria" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_categoria') echo 'selected'; ?>>Nombre Categoría</option>
          <option value="Nombre_Marca" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_Marca') echo 'selected'; ?>>Nombre Marca</option>
          <option value="nombre_talla" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'nombre_talla') echo 'selected'; ?>>Nombre Talla</option>
          <option value="Nombre_proveedor" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_proveedor') echo 'selected'; ?>>Nombre Proveedor</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
        
      </div>
    </form>
    <table>
      <tr>
        <th>ID Producto</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad Disponible</th>
        <th>Descripción</th>
        <th>ID Categoría</th>
        <th>ID Marca</th>
        <th>ID Talla</th>
        <th>ID Proveedor</th>
        <th>Foto</th>
        <th>Acciones</th>
      </tr>
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

      // Consultar los datos de la tabla productos
      $sql = "SELECT c.id_producto, c.Nombre, c.Precio, c.Cantidad_dispo, c.descripcion,c.foto, l.Nombre_categoria, m.Nombre_Marca, cd.nombre_talla, j.Nombre_proveedor 
              FROM producto c
              INNER JOIN categoria l ON c.id_categoria = l.id_categoria
              INNER JOIN marca m ON c.id_marca = m.id_marca
              INNER JOIN talla cd ON c.id_talla = cd.id_talla
              INNER JOIN proveedor j ON c.id_proveedor = j.id_proveedor";
      // Verificar si se enviaron los parámetros de búsqueda
      if (isset($_GET['columna']) && isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $columna = $_GET['columna'];
        $buscar = $_GET['buscar'];
        $sql .= " WHERE $columna LIKE '%$buscar%'";
      }

      $resultado = mysqli_query($conn, $sql);

      if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<tr>";
          echo "<td>" . $fila["id_producto"] . "</td>";
          echo "<td>" . $fila["Nombre"] . "</td>";
          echo "<td>" . $fila["Precio"] . "</td>";
          echo "<td>" . $fila["Cantidad_dispo"] . "</td>";
          echo "<td>" . $fila["descripcion"] . "</td>";
          echo "<td>" . $fila["Nombre_categoria"] . "</td>";
          echo "<td>" . $fila["Nombre_Marca"] . "</td>";
          echo "<td>" . $fila["nombre_talla"] . "</td>";
          echo "<td>" . $fila["Nombre_proveedor"] . "</td>";
          echo "<td><img src='imagenes/" . $fila["foto"] . "' alt='Foto del producto' width='100' height='100'></td>";
          echo "<td>";
          echo "<a class='btn-insertar' href='insertar_producto.php'>Insertar</a>";
          echo "<a class='btn-eliminar' href='elimina_producto.php?id=" . $fila["id_producto"] . "'>Eliminar</a>";
          echo "<a class='btn-modificar' href='modificar_producto.php?id=" . $fila["id_producto"] . "'>Modificar</a>";
          echo "</td>";
          echo "</tr>";
		}
	} else {
	  echo "<tr><td colspan='10'>No se encontraron resultados</td></tr>";
	}
  
	mysqli_close($conn);
	?>
  </table>
	</div>
</body>
</html>

     
