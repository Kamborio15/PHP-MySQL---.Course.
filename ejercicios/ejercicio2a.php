<?php
$titulo="Conversor a pesetas o euros.";
$descripcion="Introduce una cantidad y elige a qué moneda la quieres convertir.";

include('../inc/header2.php'); ?>
		
	<h4>Conversor</h4>

	<form action="ConversorTotal.php" method="post">
		
		<div id="campo">
			<label for="inputCantidad">Cantidad:</label>
			<input id="inputCantidad" name="inputCantidad">
		</div>
		<br>
		<br>
		<div id="botones" style ="inline">
			<button type="submit" name="enviarPeseta" id="enviarPeseta">Paso a Pesetas</button>
			<button type="submit" name="enviarEuro" id="enviarEuro">Paso a Euros</button>
		</div>
	</form>

<?php include('../inc/footer2.php'); ?>
