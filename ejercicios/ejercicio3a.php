<?php 

$titulo="Validación en un fichero";
$descripcion="EL formulario y la acción se encuentran en el mismo archivo.";

include('../inc/header2.php'); ?>
	<form name="formularioMayorMenor" method="POST" action="#">

		<p>Calcula qué numero es mayor</p><br>
		<div>
			<label for="inputUno">Primer valor</label>
			<input name="inputUno" id="inputUno">	
		</div>
		<div>
			<label for="inputDos">Segundo valor</label>
			<input name="inputDos" id="inputDos">	
		</div>

		<input type="submit" name="enviar" id="enviar" value="Enviar">

	</form>

<?php 
	if(isset($_POST) && !empty($_POST)){
		if(isset($_POST["inputUno"]) && !empty($_POST["inputUno"]) &&
			 isset($_POST["inputDos"]) && !empty($_POST["inputDos"])){ 
			// Llegan datos por POST y no son campos vacios
			$numero1 = $_POST['inputUno'];
			$numero2 = $_POST['inputDos'];
			
			// Datos validados
			if($numero1 > $numero2){
				echo $numero1 . ' es mayor que ' . $numero2 . '.';
			}elseif($numero1 < $numero2){
				echo $numero1 . ' es menor que ' . $numero2 . '.';
			}else{
				echo 'Ambos números son iguales.';
			}
		}
		else{
			// Error campos vacios
			echo "Ha enviado campos sin valores, debe rellenar todos campos.";
		}
	}

include('../inc/footer2.php'); ?>
