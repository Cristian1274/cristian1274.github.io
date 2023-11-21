<!DOCTYPE html>
<html>
<head>
  <title>Proveedores</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>PROVEEDORES</h1>
    <br>
    <form method="GET" action="consulta_proveedor.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_proveedor" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_proveedor') echo 'selected'; ?>>ID Proveedor</option>
          <option value="Nombre_proveedor" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Nombre_proveedor') echo 'selected'; ?>>Nombre</option>
          <option value="Direccion" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Direccion') echo 'selected'; ?>>Dirección</option>
          <option value="Correo_Electronico" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Correo_Electronico') echo 'selected'; ?>>Correo Electrónico</option>
          <option value="Telefono" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'Telefono') echo 'selected'; ?>>Teléfono</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Proveedor</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Correo Electrónico</th>
        <th>Teléfono</th>
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

      // Consultar los datos de la tabla proveedores
      $sql = "SELECT id_proveedor, Nombre_proveedor, Direccion, Correo_Electronico, Telefono FROM proveedor";

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
          echo "<td>" . $fila["id_proveedor"] . "</td>";
          echo "<td>" . $fila["Nombre_proveedor"] . "</td>";
          echo "<td>" . $fila["Direccion"] . "</td>";
          echo "<td>" . $fila["Correo_Electronico"] . "</td>";
          echo "<td>" . $fila["Telefono"] . "</td>";
          echo "<td>";
          echo "<a class='btn-insertar' href='insertar_proveedor.php'>Insertar</a>";
          echo "<a class='btn-eliminar' href='elimina_proveedor.php?id=" . $fila["id_proveedor"] . "'>Eliminar</a>";
          echo "<a class='btn-modificar' href='modificar_proveedor.php?id=" . $fila["id_proveedor"] . "'>Modificar</a>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
      }
      mysqli_close($conn);
      ?>
    </table>
  </div>
</body>
</html>

