<!DOCTYPE html>
<html>
<head>
  <title>Tallas</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>TALLAS</h1>
    <br>
    <form method="GET" action="consulta_talla.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_talla" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_talla') echo 'selected'; ?>>ID Talla</option>
          <option value="nombre_talla" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'nombre_talla') echo 'selected'; ?>>Nombre de Talla</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Talla</th>
        <th>Nombre de Talla</th>
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

      // Consultar los datos de la tabla tallas
      $sql = "SELECT id_talla, nombre_talla FROM talla";

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
          echo "<td>" . $fila["id_talla"] . "</td>";
          echo "<td>" . $fila["nombre_talla"] . "</td>";
          echo "<td>";
          echo "<a class='btn-insertar' href='insertar_talla.php'>Insertar</a>";
          echo "<a class='btn-eliminar' href='elimina_talla.php?id=" . $fila["id_talla"] . "'>Eliminar</a>";
          echo "<a class='btn-modificar' href='modificar_talla.php?id=" . $fila["id_talla"] . "'>Modificar</a>";
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
