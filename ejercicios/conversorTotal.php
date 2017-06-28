<?php 
$titulo="¿Cuántos euros son...?";
$descripcion="Introduce una cantidad y elige a qué moneda la quieres convertir.";
include('../inc/header2.php');

	define("EURO", 166.386);

	if (isset($_POST['enviarPeseta']) && !empty($_POST['inputCantidad'])){
		// Paso a pesetas

		echo $_POST['inputCantidad'] . " euros equivalen a " . number_format($_POST['inputCantidad']*EURO, 2). " pesetas.";
	} else if (isset($_POST['enviarEuro']) && !empty($_POST['inputCantidad'])){
		// Paso a euros

		echo $_POST['inputCantidad'] . " pesetas equivalen a " . number_format($_POST['inputCantidad']/EURO, 2). " euros.";

	} else{
		echo "No ha introducido una cantidad.";
	} ?>

	<a href="ejercicio2a.php">Volver</a>
	
	<?php include('../inc/footer2.php'); ?>
	