<?php
$titulo = "Suma de números con JavaScript";
$descripcion = "Uso de JavaScript y jQuery";

include('../inc/header2.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/suma.js"></script>

	<form id="formSuma" action="#" method="post">
		<div>
			<label for="inputUno">Numero 1:</label>
			<input id="inputUno" required>
		</div>
		<div>
			<label for="inputDos">Numero 2:</label>
			<input id="inputDos" required>
		</div>


		<br><button name="enviar" id="enviar" type="submit">Calcular</button>
	</form>
	<div>
		<p id="resultado"></p>
	</div>
	
<?php  
	include('../inc/footer2.php');
?>
