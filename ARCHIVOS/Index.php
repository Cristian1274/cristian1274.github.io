<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ESTILOS/estilos.css">
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
               
                <p>Paraje el rio, S/N La magdalena         Chichicaspa, C.P, 527773, Huxqulucan, Estado de Mexico Estado de Mexico </p>
            </div>
        </div>
    </footer>
		<img src="imagenes/LOGO.jpg" class="imagen" alt="" > <h1 >JOAN 5</h1>
	
	
	
<div class="container3">
	<div class="CARRI">
		<a href="carrito.php" ><img src="imagenes/carrito.jpg" height ="100" width="100" /></a>
	</div>

	<p >MODELO:CTV-138</p>
	<img src="imagenes/OFERTA2.jpg" class="image" alt="" >
	
</div>
	<div class="container1">

	<br>
	<div class="container2">
		<h2>CATEGORIA</h2>
	</div>		
</div>
	
	<div class="container">
		
		<input type="radio" name="slider" id="item-1" checked>
    <input type="radio" name="slider" id="item-2">
    <input type="radio" name="slider" id="item-3">
  <div class="cards">
    <label class="card" for="item-1" id="song-1">
      <img src="imagenes/hombre.jpg" alt="song">
	  <input type="button" class="boton" onclick="location.href='Hombre.php';" value="Hombre" />
    </label>
    <label class="card" for="item-2" id="song-2">
      <img src="imagenes/mujer.jpg" alt="song">
	  <input type="button" class="boton" onclick="location.href='mujer.php';" value="Mujer" />
    </label>
    <label class="card" for="item-3" id="song-3">
      <img src="imagenes/niño.jpg" alt="song">
	  <input type="button" class="boton" onclick="location.href='niño.php';" value="Niño" />
    </label>
  </div>

</div>
	<div class="container4">
		
		
		
		<br><h3>NIKE colo rojo con negro     $600</h3>	
		<div class="valoracion">
			<h3>Calificaciones:30</h3>
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
	 


	

	<script>
		var carousel = document.querySelector(".carousel");
		var items = document.querySelectorAll(".item");

		var prev = document.querySelector("#prev");
		var next = document.querySelector("#next");

		var counter = 0;
		var itemWidth = items[0].clientWidth + 20;

		function moveCarousel() {
			carousel.style.transform = "translateX(" + (-itemWidth * counter) + "px)";
		}

		next.addEventListener("click", function() {
            if (counter >= items.length - 1) return;
            counter++;
            moveCarousel();
        });
    
        prev.addEventListener("click", function() {
            if (counter <= 0) return;
            counter--;
            moveCarousel();
        });
        
        var botonesAgregar = document.querySelectorAll(".agregar-carrito");

    </script>
    </body>
    </html>
    