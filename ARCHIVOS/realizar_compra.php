<?php
session_start();
$productos = $_SESSION['carrito'];

// Calcular el total de la compra
$total = 0;
foreach ($productos as $producto) {
    $precio = floatval($producto['precio']);
$cantidad = floatval($producto['cantidad']);

$total += floatval($producto['precio']) * floatval($producto['cantidad']);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="compra.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Confirmar Compra</title>
</head>
<body>
   
    <div class="container">
    
    <h1>Confirmar Compra</h1>  
    
    <form action="confirmacion_compra.php" method="POST">
        <label for="numero_tarjeta">Número de Tarjeta:</label>
        <input type="text" id="numero_tarjeta" name="numero_tarjeta" minlength="16"   maxlength="16" required>
<br>
        <label for="fecha_tarjeta">Fecha de Tarjeta:</label>
        <input type="text" id="fecha_tarjeta" name="fecha_tarjeta" minlength="4" maxlength="4"required>
<br>
        <label for="cvv_tarjeta">CVV de Tarjeta:</label>
        <input type="text" id="cvv_tarjeta" name="cvv_tarjeta" minlength="3" maxlength="3" required>
<br>
        <label for="direccion">Dirección de Envío:</label>
        <textarea id="direccion" name="direccion" required></textarea>
<br>
        <h2>Total de la Compra: <?php echo $total; ?></h2>
        <br>
        <input type="submit" value="Realizar Pago" id="btnPago">

    </form>
    
  
    </div>
    	

    <button onclick="window.location.href='carrito.php'"><i class='bx bx-arrow-back icon'></i></button>
    
    <div class="CARRI">
            <a href="carrito.php"><img src="imagenes/carrito.jpg" height="100" width="100" /></a>
        </div>
        <!-- Tarjeta -->
		<section class="tarjeta" id="tarjeta">
			<div class="delantera">
				<div class="logo-marca" id="logo-marca">
					<!-- <img src="img/logos/visa.png" alt=""> -->
				</div>
				<img src="imagenes/chip-tarjeta.png" class="chip" alt="">
				<div class="datos">
					<div class="grupo" id="numero">
						<p class="label">Número Tarjeta</p>
						<p class="numero">#### #### #### ####</p>
					</div>
					<div class="flexbox">
						<div class="grupo" id="nombre">
							<p class="label">Nombre Tarjeta</p>
							<p class="nombre">Jhon Doe</p>
						</div>

						<div class="grupo" id="expiracion">
							<p class="label">Expiracion</p>
							<p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
						</div>
					</div>
				</div>
			</div>

			<div class="trasera">
				<div class="barra-magnetica"></div>
				<div class="datos">
					<div class="grupo" id="firma">
						<p class="label">Firma</p>
						<div class="firma"><p></p></div>
					</div>
					<div class="grupo" id="ccv">
						<p class="label">CCV</p>
						<p class="ccv"></p>
					</div>
				</div>
				<p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
				<a href="#" class="link-banco">www.tubanco.com</a>
			</div>
		</section>
<script>
    document.getElementById("btnPago").addEventListener("click", function(event) {
  var confirmacion = confirm("¿Estás seguro de realizar la compra?");

  if (!confirmacion) {
    event.preventDefault(); // Evita que se envíe el formulario si se cancela la confirmación
  }
});
</script>
</html>
