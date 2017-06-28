<?php 
$titulo = "Convertir pesetas.";
$descripcion = "Conversión de pesetas a euros.";

include('../inc/header2.php');
?>
		
		<p>¿Cuántos euros son...?</p>

		<form action="ConversorEuros.php" method="post">
			
			<label for="inputPeseta">Pesetas:</label>
			<input id="inputPeseta" name="inputPeseta">

			<br><button type="submit" name="enviar" id="enviar">Calcular</button>

		</form>

	<?php include('../inc/footer2.php'); ?>
	