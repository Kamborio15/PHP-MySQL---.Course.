<?php 

$titulo="Mayor o menor";
$descripcion="Introduce dos cantidades y determina si es mayor o menor";

include('../inc/header2.php'); ?>
	<form name="formularioMayorMenor" method="POST" action="MayorMenor.php">

		<p>Calcula qué numero es mayor</p><br>
		<div>
			<label for="inputUno">Primer valor</label>
			<input name="inputUno" id="inputUno">	
		</div>
		<div>
			<label for="inputDos">Segundo valor</label>
			<input name="inputDos" id="inputDos">	
		</div>

		<button type="submit" name="enviar" id="enviar">Calcular</button>


	</form>

<?php include('../inc/footer2.php'); ?>
