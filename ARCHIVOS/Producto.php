<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="PRODUCTO.css">
    <title>Detalles del Producto</title>
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
            $rutaImagen = $fila['foto'];

            echo "<div class='container1'>";
            echo "<h1>Producto</h1>";
            echo "<img src='imagenes/$rutaImagen' alt='Imagen del Producto'>";
            echo "<h2>$nombre</h2>";
            echo "<p>$$precio</p>";
            echo "<p>$descripcion</p>";
            echo "</div>";
            echo "<h3>Colores Disponibles</h3>";
            echo "<div class='color-circle' style='background-color: color1;'></div>";
            echo "<div class='color-circle' style='background-color: color2;'></div>";
            echo "<div class='color-circle' style='background-color: color3;'></div>";
            echo "<h3>Tallas Disponibles</h3>";
            echo "<select name='sizes' id='sizes'>";
            echo "<option value='size1'>Talla 1</option>";
            echo "<option value='size2'>Talla 2</option>";
            echo "<option value='size3'>Talla 3</option>";
            echo "</select>";
            echo "<button>Agregar al Carrito</button>";
        } else {
            echo "Producto no encontrado.";
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    ?>

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
                <p>Paraje el rio, S/N La magdalena Chichicaspa, C.P, 527773, Huixquilucan, Estado de Mexico</p>
                </div>
        </div>
    </footer>
</body>
</html>
