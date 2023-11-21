<?php
session_start(); // Iniciar la sesión para mantener los productos en el carrito

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    echo "<h1>Carrito de Compras</h1>";
    echo "<p>No hay productos en el carrito.</p>";
    echo "<a href='Hombre.php'>Continuar Comprando</a>";
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j5";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ESTILOS/carrito.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Carrito de Compras</title>
</head>
<body>
   
<div class="container">
<?php

// Verificar si el cliente ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['Id_Rol'] === 3) {
    echo "<button class='gray-button' onclick=\"window.location.href='cerrar_sesion.php';\">Cerrar sesión</button>";
    //echo "<button class='gray-button' onclick=\"window.location.href='carrito.php';\">hola</button>";



    // El cliente ha iniciado sesión
    // Aquí puedes mostrar el contenido de la página para clientes autenticados

    // Verificar si existe la clave 'nombre_cliente' en $_SESSION
    if (isset($_SESSION['Nombre_Cliente'])) {
        // Mostrar el nombre del cliente y otros detalles
        echo "¡Hola, " . $_SESSION['Nombre_Cliente'] . "! Bienvenido a la página.";
    } else {
        // La clave 'nombre_cliente' no está definida en $_SESSION
        
    }
} else {
    // El cliente no ha iniciado sesión o no es un cliente
    // Aquí puedes mostrar el contenido de la página para usuarios no autenticados

    // Por ejemplo, mostrar el botón de inicio de sesión
    echo "<button class='gray-button' onclick=\"window.location.href='inicio.html'\">Iniciar sesion o registrarse</button>";
    // echo "<button onclick=\"window.location.href='carrito.php'\"><i class='bx bx-arrow-back icon'></i></button>";

    
}
?>

<h2 class="tit">Carrito de Compras</h2>
<div class="container2">
    
<h1>JOAN 5</h1>
</div>
<div class="container3">
<table class="table">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Talla</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    <?php
    $cantidades_disponibles = array(); // Arreglo para almacenar las cantidades disponibles

    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        // Obtener la cantidad disponible del producto desde la base de datos
        $sql = "SELECT Cantidad_dispo FROM producto WHERE id_producto = '$id_producto'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cantidad_disponible = $row["Cantidad_dispo"];
        } else {
            $cantidad_disponible = 0; // Si no se encuentra el producto, se considera que la cantidad es 0
        }

        $cantidades_disponibles[$id_producto] = $cantidad_disponible; // Almacenar la cantidad disponible en el arreglo

        echo "<tr class='producto'>";
        echo "<td><img src='imagenes/{$producto['foto']}' alt='{$producto['nombre']}'></td>";
        echo "<td>{$producto['nombre']}</td>";
        echo "<td>$ {$producto['precio']}</td>";
        echo "<td>{$producto['talla']}</td>";
        echo "<td>";
        echo "<form method='post' action='actualizar_cantidad.php'>";
        echo "<input type='hidden' name='id_producto' value='$id_producto'>";
        echo "<input type='number' name='cantidad' value='{$producto['cantidad']}' min='1' max='$cantidad_disponible'>";
        echo "<button type='submit'>Actualizar</button>";
        echo "</form>";
        echo"<td>";
        echo "<a href='eliminar_carrito.php?id_producto=$id_producto' class='red-button'>Eliminar</a>"; 
        echo"</td>";

        
        
    }
    ?>
</table>
<br>
<a class="com" href="Hombre.php">Continuar Comprando</a>
</div>
</div>
<div class="container1">
    <img class="img1" src="imagenes/fondo3.png">
    <br>
    <?php
// Verificar si el cliente ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['Id_Rol'] === 3) {
    echo '<button class="buton1" onclick="window.location.href=\'realizar_compra.php\'">Comprar</button>';
} else {
    echo '<p>No puedes comprar hasta que inicies sesión como usuario.</p>';
}
?>
    <br>
    <button class="car-button" onclick="window.location.href='index.php'"><i class='bx bx-arrow-back icon'></i></button>
</div>


<footer class="pie-pagina">
        <div class="grupo-2">
            <b>JOAN5</b> 
        </div>
        <div class="grupo-1">
            
            <div class="box"> 
                <p>Contactanos:</p>
                <p>joanj5.tesh@gmail.com</p>
            </div>
            <div class="box">
                
                <div class="red-social">
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-whatsapp"></a>
                    <a href="#" class="fa fa-facebook"></a>
                    
                   
                    
                </div>
               
            </div>
            <div class="r">
               
                <p>Paraje el rio, S/N La magdalena         Chichicaspa, C.P, 527773, Huixquilucan, Estado de Mexico  </p>
            </div>
        </div>
    </footer>
</body>
</html>
