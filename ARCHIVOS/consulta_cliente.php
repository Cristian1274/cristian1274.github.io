<!DOCTYPE html>
<html>
<head>
  <title>Clientes</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>CLIENTES</h1>
    <br>
    <form method="GET" action="consulta_cliente.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_cliente" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_cliente') echo 'selected'; ?>>ID Cliente</option>
          <option value="Nombre_Cliente" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_Cliente') echo 'selected'; ?>>Nombre</option>
          <option value="APP_Cliente" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'APP_Cliente') echo 'selected'; ?>>Apellido Paterno</option>
          <option value="APM_Cliente" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'APM_Cliente') echo 'selected'; ?>>Apellido Materno</option>
          <option value="Correo_Electronico" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Correo_Electronico') echo 'selected'; ?>>Correo Electrónico</option>
          <option value="password" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'password') echo 'selected'; ?>>Contraseña</option>
          <option value="Id_Rol" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Id_Rol') echo 'selected'; ?>>ID Rol</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Cliente</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Correo Electrónico</th>
        <th>Contraseña</th>
        <th>ID Rol</th>
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

      // Consultar los datos de la tabla clientes
      $sql = "SELECT id_cliente, Nombre_Cliente, APP_Cliente, APM_Cliente, Correo_Electronico, password, Id_Rol FROM cliente";

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
		echo "<td>" . $fila["id_cliente"] . "</td>";
		echo "<td>" . $fila["Nombre_Cliente"] . "</td>";
		echo "<td>" . $fila["APP_Cliente"] . "</td>";
		echo "<td>" . $fila["APM_Cliente"] . "</td>";
		echo "<td>" . $fila["Correo_Electronico"] . "</td>";
		echo "<td>" . $fila["password"] . "</td>";
		echo "<td>" . $fila["Id_Rol"] . "</td>";
		echo "<td>";
		echo "<a class='btn-insertar' href='insertar_cliente.php'>Insertar</a>";
		echo "<a class='btn-eliminar' href='elimina_cliente.php?id=" . $fila["id_cliente"] . "'>Eliminar</a>";
		echo "<a class='btn-modificar' href='modificar_cliente.php?id=" . $fila["id_cliente"] . "'>Modificar</a>";
		echo "</td>";
		echo "</tr>";
		}
		} else {
		echo "<tr><td colspan='8'>No se encontraron resultados</td></tr>";
		}
		mysqli_close($conn);
?>
  </table>
	</div>
</body>
</html>