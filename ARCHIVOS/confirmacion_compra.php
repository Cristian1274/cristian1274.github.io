<?php
session_start();

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    echo "<h1>Carrito de Compras</h1>";
    echo "<p>No hay productos en el carrito.</p>";
    echo "<a href='Hombre.php'>Continuar Comprando</a>";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j5";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $fecha_tarjeta = $_POST['fecha_tarjeta'];
    $cvv_tarjeta = $_POST['cvv_tarjeta'];
    $direccion = $_POST['direccion'];

    // Generar un salt aleatorio

    // Cifrar el número de tarjeta de crédito con bcrypt
    $numero_tarjeta_cifrado = password_hash($numero_tarjeta, PASSWORD_BCRYPT);

    // Insertar los datos de la venta en la tabla "ventas"
    $sql = "INSERT INTO ventas (numero_tarjeta, fecha_tarjeta, cvv_tarjeta, direccion) VALUES ('$numero_tarjeta_cifrado', '$fecha_tarjeta', '$cvv_tarjeta', '$direccion')";

    if ($conn->query($sql) === TRUE) {
        // Éxito al insertar los datos de la venta

        // Obtener el ID de la factura recién insertada
        $id_factura = $conn->insert_id;

        // Insertar los productos de la venta en la tabla "productos_venta"
        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $fecha = date("Y-m-d"); // Obtener la fecha actual
            $correo = $_SESSION['Correo_Electronico']; // Obtener el correo electrónico de la sesión
        
            $sql = "INSERT INTO productos_venta (id_FAC, id_producto, cantidad, precio, fecha, correo) VALUES ('$id_factura', '$id_producto', '$cantidad', '$precio', '$fecha', '$correo')";
        
            if ($conn->query($sql) !== TRUE) {
                // Error al insertar el producto en la venta
                echo "Error al insertar el producto en la venta: " . $conn->error;
                exit();
            }
        }

        // Limpiar el carrito después de realizar la compra
        
        // Limpiar el carrito
    } else {
        // Error al insertar los datos de la venta
        echo "Error al insertar los datos de la venta: " . $conn->error;
        exit();
    }
}

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    echo "<h1>Carrito de Compras</h1>";
    echo "<p>No hay productos en el carrito.</p>";
    echo "<a href='Hombre.php'>Continuar Comprando</a>";
    exit();
}


// Obtener los detalles de los productos en el carrito
$productos = $_SESSION['carrito'];

// Calcular el total de la compra
$total = 0;
foreach ($productos as $producto) {
    $total += floatval($producto['precio']) * floatval($producto['cantidad']);
}

// Generar el número de factura
$id_factura = uniqid();

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'j5');

// Verificar si la conexión fue exitosa
if ($conexion->connect_errno) {
    echo "Error al conectar con la base de datos: " . $conexion->connect_error;
    exit();
}

// Actualizar la cantidad de los productos en la tabla "producto"
foreach ($productos as $id_producto => $producto) {
    $nuevaCantidad = $producto['cantidad'];

    // Restar la cantidad del producto en la tabla "producto"
    $sql = "UPDATE producto SET Cantidad_dispo = Cantidad_dispo - $nuevaCantidad WHERE id_producto = $id_producto";

    if ($conexion->query($sql) !== TRUE) {
        // Ocurrió un error al actualizar la cantidad del producto
        echo "Error al actualizar la cantidad del producto: " . $conexion->error;
        $conexion->close();
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ticket.css">
    
    <script src="scripts.js"></script>


    <title>Confirmación de Compra</title>
</head>
<body>
    <!-- Contenido del ticket -->

    <div class="container">
        <h2>Confirmación de Compra</h2>

        <div class="ticket-info">
            <h3>Número de Factura: <?php echo $id_factura; ?></h3>
            <h3>Fecha de Compra: <?php echo date("Y-m-d"); ?></h3>
            <h3>Correo Electrónico: <?php echo $correo; ?></h3> <!-- Nuevo campo: correo electrónico -->
        </div>

        <h4>Detalles de la Compra:</h4>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
            <?php foreach ($productos as $producto) : ?>
            <tr>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['precio'] * $producto['cantidad']; ?></td>
            </tr>
            <?php endforeach; 
            unset($_SESSION['carrito']);?>
        </table>

        <h4>Total de la Compra: <?php echo $total; ?></h4>

        <p>¡Gracias por tu compra!</p>
        <a href="Hombre.php">Continuar Comprando</a>
        
        <button onclick="imprimirPagina()">Imprimir</button>


    </div>
    

<script>
function imprimirPagina() {
window.print();

}
</script>
</body>
</html>
