<?php
$titulo = "Suma de números";
$descripcion = "Se insertan dos números y se muestra la suma. Además se selecciona radio button.";

include('../inc/header2.php'); ?>

	<form action="calculo.php" method="post">
		<div>
			<label for="inputUno">Numero 1:</label>
			<input id="inputUno" name="inputUno">
		</div>
		<div>
			<label for="inputDos">Numero 2:</label>
			<input id="inputDos" name="inputDos">
		</div>

		<p>Coche</p>
		<input type="radio" name="coche" id="coche_si" value="Si"><label for="coche_si" checked >Si</label>
		<input type="radio" name="coche" id="coche_no" value="No"><label for="coche_no">No</label>

		<br><button name="enviar" id="enviar" type="submit">Calcular</button>
	</form>
<?php include('../inc/footer2.php'); ?>
