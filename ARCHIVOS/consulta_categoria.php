<!DOCTYPE html>
<html>
<head>
  <title>Categoría</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>Categoría</h1>
    <br>
    <form method="GET" action="consulta_categoria.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_categoria" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_categoria') echo 'selected'; ?>>ID Categoría</option>
          <option value="Nombre_categoria" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_categoria') echo 'selected'; ?>>Nombre de Categoría</option>
          <option value="Descripcion" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Descripcion') echo 'selected'; ?>>Descripción</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Categoría</th>
        <th>Nombre de Categoría</th>
        <th>Descripción</th>
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

      // Consultar los datos de la tabla categorias
      $sql = "SELECT id_categoria, Nombre_categoria, Descripcion FROM categoria";

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
          echo "<td>" . $fila["id_categoria"] . "</td>";
          echo "<td>" . $fila["Nombre_categoria"] . "</td>";
          echo "<td>" . $fila["Descripcion"] . "</td>";
          echo "<td>";
          echo "<a class='btn-insertar' href='insertar_categoria.php'>Insertar</a>";
          echo "<a class='btn-eliminar' href='elimina_categoria.php?id=" . $fila["id_categoria"] . "'>Eliminar</a>";
          echo "<a class='btn-modificar' href='modificar_categoria.php?id=" . $fila["id_categoria"] . "'>Modificar</a>";
          echo "</td>";
          echo "</tr>";
		}
	} else {
	  echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
	}
  
	mysqli_close($conn);
	?>
	
	  </table>
		</div>
	</body>
	</html>
