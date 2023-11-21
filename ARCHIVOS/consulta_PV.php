<!DOCTYPE html>
<html>
<head>
  <title>Productos Venta</title>
  <link rel="stylesheet" href="consulta.css">
</head>
<body>
  <div class="container">
    <h1>PRODUCTOS VENTA</h1>
    <br>
    <form method="GET" action="consulta_productos_venta.php">
      <div class="search-container">
        <select name="columna">
          <option value="id_FAC" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_FAC') echo 'selected'; ?>>ID Factura</option>
          <option value="id_producto" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'id_producto') echo 'selected'; ?>>ID Producto</option>
          <option value="cantidad" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'cantidad') echo 'selected'; ?>>Cantidad</option>
          <option value="precio" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'precio') echo 'selected'; ?>>Precio</option>
          <option value="fecha" <?php if(isset($_GET['columna']) && $_GET['columna'] == 'fecha') echo 'selected'; ?>>Fecha</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar..." value="<?php if(isset($_GET['buscar'])) echo $_GET['buscar']; ?>">
        <button type="submit">Buscar</button>
      </div>
    </form>
    <table>
      <tr>
        <th>ID Factura</th>
        <th>ID Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>correo</th>
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

      // Consultar los datos de la tabla productos_venta
      $sql = "SELECT pv.id_FAC, p.Nombre, pv.cantidad, pv.precio, pv.fecha,pv.correo
        FROM productos_venta pv
        INNER JOIN producto p ON pv.id_producto = p.Id_producto";


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
          echo "<td>" . $fila["id_FAC"] . "</td>";
          echo "<td>" . $fila["Nombre"] . "</td>";
          echo "<td>" . $fila["cantidad"] . "</td>";
          echo "<td>" . $fila["precio"] . "</td>";
          echo "<td>" . $fila["fecha"] . "</td>";
          echo "<td>" . $fila["correo"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
    }
    mysqli_close($conn);
?>
  </table>
</div>
</body>
</html>
