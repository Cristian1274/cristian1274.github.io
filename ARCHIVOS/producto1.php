<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="PRODUCTO.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    
    
<img class="FON" src="imagenes/fondo6.jpeg" alt='Imagen del Producto'>

    <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'j5');

        // Verificar la conexión
        if (!$conexion) {
            die('Error al conectar a la base de datos: ' . mysqli_connect_error());
        }

        // Obtener el id_producto desde la URL
        $id_producto = $_GET['id_producto'];

        // Obtener los detalles del producto de la base de datos
        $sql = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($conexion, $sql);

        // Mostrar los detalles del producto
        if ($fila = mysqli_fetch_assoc($resultado)) {
            $nombre = $fila['Nombre'];
            $precio = $fila['Precio'];
            $descripcion = $fila['descripcion'];
            $cantidad = $fila['Cantidad_dispo'];
            $rutaImagen = $fila['foto'];
            $tallasDisponibles = explode(",", $fila['id_talla']); // Obtener un array de las tallas separadas por comas
            

            ;
        } else {
            echo "Producto no encontrado.";
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    ?>
            
                <div class="container1">
                <?php
session_start(); // Iniciar la sesión

// Verificar si el cliente ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['Id_Rol'] === 3) {
    echo "<button class='gray-button' onclick=\"window.location.href='cerrar_sesion.php';\">Cerrar sesión</button>";
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
}
?>
                <div class="PRODUC">
                    <h1>Producto</h1>
                    </div>
                    <div class="IMAG">
                    <?php
                       echo" <img src='imagenes/$rutaImagen' alt='Imagen del Producto'>"
                        ?>

<form action="agregar_carrito.php" method="get">
    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
    <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                
        <div class="TALL">      
    <label for="id_talla">Talla:</label>
    <select id="id_talla" name="id_talla" required>
        <?php
            $tallasDisponibles = explode(",", $fila['id_talla']); // Obtener un array de las tallas separadas por comas
            foreach ($tallasDisponibles as $talla) {
                echo "<option value='$talla'>$talla</option>";
            }
        ?>
    </select>
    </div>                         
                </div>
          
                </div>
                <div class="container2">
                <?php
                echo"
                        <h2>$nombre</h2>
                        <h2>Precio: </h2>
                        <h1>$$precio </h1>
                        <p>$descripcion</p>
                        <h3>Cantidad Disponible: $cantidad </h3>
                        "
                        ?>
          <a class="ag" href="agregar_carrito.php?id_producto=<?php echo $id_producto; ?>&nombre=<?php echo urlencode($nombre); ?>&precio=<?php echo $precio; ?>&id_talla=<?php echo urlencode($talla); ?>&cantidad=<?php echo $cantidad; ?>&foto=<?php echo urlencode($rutaImagen); ?>">Agregar al Carrito</a>

                   </form>
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

