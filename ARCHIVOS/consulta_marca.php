<!DOCTYPE html>
<html>
<head>
  <title>Marcas</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>MARCAS</h1>
    <br>
    <form method="GET" action="consulta_marca.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_marca" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_marca') echo 'selected'; ?>>ID Marca</option>
          <option value="Nombre_Marca" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_Marca') echo 'selected'; ?>>Nombre de Marca</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Marca</th>
        <th>Nombre de Marca</th>
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

      // Consultar los datos de la tabla marcas
      $sql = "SELECT id_marca, Nombre_Marca FROM marca";

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
          echo "<td>" . $fila["id_marca"] . "</td>";
          echo "<td>" . $fila["Nombre_Marca"] . "</td>";
          echo "<td>";
          echo "<a class='btn-insertar' href='insertar_marca.php'>Insertar</a>";
          echo "<a class='btn-eliminar' href='elimina_marca.php?id=" . $fila["id_marca"] . "'>Eliminar</a>";
          echo "<a class='btn-modificar' href='modificar_marca.php?id=" . $fila["id_marca"] . "'>Modificar</a>";
          echo "</td>";
          echo "</tr>";
		}
	} else {
	  echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
	}
  
	mysqli_close($conn);
	?>
  </table>
	</div>
</body>
</html>
