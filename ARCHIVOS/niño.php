<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ESTILOS/estilo.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Carrusel de calzado</title>
    
</head>
<body>
<?php
session_start(); // Iniciar la sesión

// Verificar si el cliente ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['Id_Rol'] === 3) {
    echo "<button class='gray-button' onclick=\"window.location.href='cerrar_sesion.php';\">Cerrar sesión</button>";
    echo "<button class='car-button' onclick=\"window.location.href='index.php'\"><i class='bx bx-arrow-back icon'></i></button>";
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
    echo "<button class='car-button' onclick=\"window.location.href='index.php'\"><i class='bx bx-arrow-back icon'></i></button>";
}
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
               
                <p>Paraje el rio, S/N La magdalena         Chichicaspa, C.P, 527773, Huixquilucan, Estado de Mexico  </p>
            </div>
        </div>
    </footer>
    <img src="imagenes/LOGO.jpg" class="imagen" alt=""><h1>JOAN 5</h1>

    <div class="container3">
        <div class="CARRI">
            <a href="carrito.php"><img src="imagenes/carrito.jpg" height="100" width="100" /></a>
        </div>

        <div id="selectedShoeContainer" class="selected-shoe">
            <div id="selectedShoeImageContainer"></div>
        </div>

        <div class="container4">
            <div id="selectedShoeDetailsContainer"></div>

            <div class="valoracion">
                <h3>Calificaciones</h3>
                <input id="radio1" type="radio" name="estrellas" value="5">
                <label for="radio1">★</label>
                <input id="radio2" type="radio" name="estrellas" value="4">
                <label for="radio2">★</label>
                <input id="radio3" type="radio" name="estrellas" value="3">
                <label for="radio3">★</label>
                <input id="radio4" type="radio" name="estrellas" value="2">
                <label for="radio4">★</label>
                <input id="radio5" type="radio" name="estrellas" value="1">
                <label for="radio5">★</label>
            </div>
        </div>
    </div>

    <div class="container1">
    <form method="get" action="">
        <input type="search" name="busquedacodigo" size="25" maxlength="7" placeholder="BUSCAR">
        <input type="submit" value="Buscar">
    </form>

	
	<div class="container2">
		<h2>NIÑO</h2>
	</div>		
</div>

    <div class="container5">
        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'j5');

        // Verificar la conexión
        if (!$conexion) {
            die('Error al conectar a la base de datos: ' . mysqli_connect_error());
        }
        $termino = isset($_GET['busquedacodigo']) ? $_GET['busquedacodigo'] : '';


        $sql = "SELECT * FROM producto WHERE id_categoria = 3";
        if (!empty($termino)) {
            $sql .= " AND Nombre LIKE '%$termino%'";
        }
        $resultados = mysqli_query($conexion, $sql);
    

        // Mostrar los productos
        while ($fila = mysqli_fetch_assoc($resultados)) {
            $id_producto = $fila['id_producto'];
            $nombre = $fila['Nombre'];
            $precio = $fila['Precio'];
            $descripcion = $fila['descripcion'];
            $rutaImagen = $fila['foto'];
            
           
        
            echo '
    <div class="shoe-item" onclick="showShoeDetails(\''.$nombre.'\', '.$precio.', \''.$rutaImagen.'\', \''.$descripcion.'\')">
        <img class="shoe-image" src="imagenes/'.$rutaImagen.'" alt="'.$nombre.'">
        <div>
            <strong>Nombre:</strong> '.$nombre.'
            <br>
            <strong>Precio:</strong> '.$precio.'
            <br>
            <strong>Descripción:</strong> '.$descripcion.'
            <br>
            <div class="button-container">
                <a class="button" href="producto1.php?id_producto='.$fila['id_producto'].'">Entrar</a>
            </div>
        </div>
    </div>
';
        }

        // Cerrar la conexión
        mysqli_close($conexion);
        ?>
    </div>

    <script>
        var selectedRating = 0;

        function showShoeDetails(nombre, precio, rutaImagen, descripcion) {
            var selectedShoeImageContainer = document.getElementById("selectedShoeImageContainer");
            var selectedShoeDetailsContainer = document.getElementById("selectedShoeDetailsContainer");

            selectedShoeImageContainer.innerHTML = `
                <img class="selected-shoe-image" src="imagenes/${rutaImagen}" alt="${nombre}">
            `;

            selectedShoeDetailsContainer.innerHTML = `
                <strong>Nombre:</strong> ${nombre}
                <br>
                <strong>Precio:</strong> $${precio}
                <br>
                <strong>Descripción:</strong> ${descripcion}
            `;
        }
    </script>
</body>
</html>
