<?php

$titulo="Suma de números comprendidos entre dos números dados.";
$descripcion="Introducir dos números y sumar todos los comprendidos entre ellos ";

include('../inc/header2.php');
?>
<form id="sumaComprendidos" action="#" method="POST" style="width:50%;">
	<div class="form-group">
		<label for="inputUno">Primer numero</label>
		<input type="text" class="form-control" name="inputUno" id="inputUno"/>
	</div>
	<div class="form-group">
		<label for="inputDos">Segundo numero</label>
		<input type="text" class="form-control" name="inputDos" id="inputDos"/>
	</div>
	<div><input type="submit" name="enviar" id="enviar" value="Enviar"/></div>

</form>
<?php

	// Realizamos la acción para el envio del formulario
	if(isset($_POST) && !empty($_POST)){

		$num1 = $_POST['inputUno'];
		$num2 = $_POST['inputDos'];
		$total = 0;

		// Si num1 es menor que num2
		if($num1 < $num2){
			$i = $num1;
			while($i <= $num2){
				$total += $i;
				$i++;
			}
			echo "<p>La suma de los números comprendidos entre 
			$num1 y $num2 (ambos incluidos) es $total</p>";
		}else{
			echo "<p>El primer número debe ser menor que el segundo número.</p>";
		}
	}
include('../inc/footer2.php');
?>