<?php

$titulo = "Múltiplos para un rango de números";
$descripcion = "Muestra todos los números cuyos múltiplos se han seleccionado para un rango de valores.";

include('../inc/header2.php'); ?>
	<form action="#" method="POST">
		
		<div>
			<label for="inputRangoMinimo" >Valor mínimo</label>
			<input type="text" name="inputRangoMinimo" id="inputRangoMinimo" required>
		</div>
		<div>
			<label for="inputRangoMaximo">Valor máximo</label>
			<input type="text" name="inputRangoMaximo" id="inputRangoMaximo" required>
		</div>

		<div>
		<?php  
			for($i = 1; $i < 10; $i++){?>
				<label class="checkbox-inline">
					<input type="checkbox" id="multiplos" name="multiplos[]" value="<?php echo $i; ?>"><?php echo $i; ?>
				</label>
				
			<?php } ?>
		</div>
		<div>
			<input type="submit" name="enviar" id="enviar" value="Enviar"/>
		</div>
	</form>
<?php

////////////////////////  PARTE 1 - 


// Escribir todos los números de 3 y 5 entre 30 y 75.
/*
$iLimiteBajo = 30;
$iLimiteAlto = 75;

echo "Escribir todos los números de 3 y 5 entre 30 y 75.<br><br>";
$i = 30;
do{
	$mensaje = "";
	$bMultiploTres = false;
	$bMultiploCinco = false;
	// Si es multiplo de 3
	if($i % 3 == 0){
		$mensaje = "El número $i es multiplo de 3";
		$bMultiploTres = true;
	}
	// Si es multiplo de 5
	if($i % 5 == 0){
		if($bMultiploTres){
			$mensaje .= " y de 5";
		}
		else{
			$mensaje = "El número $i es multiplo de 5";
		}
		$bMultiploCinco = true;
	}

	if($bMultiploTres || $bMultiploCinco){
		$mensaje .= ".<br>";
	}

	echo $mensaje."";
	$i++;
}while($i >= $iLimiteBajo && $i <= $iLimiteAlto);
*/
////////////////////////  FIN PARTE 1 - 


////////////////////////  PARTE 2 - AÑADIR UN FORMULARIO Y QUE EL USUARIO ESCOJA LOS VALORES

if(isset($_POST) && !empty($_POST)){
	// Post-action

	$iRangoMinimo = $_POST['inputRangoMinimo'];
	$iRangoMaximo = $_POST['inputRangoMaximo'];

	// $aNumerosMultiplos es un array con los checkboxes seleccionados
	$aNumerosMultiplos = $_POST['multiplos'];

	$sMensaje = "";
	// Empezamos a contar desde el rango minimo
	$iCont = $iRangoMinimo;
	
	do{
		// Boolean para los casos que un numero tenga varios multiplos en el array
		$bMultiploEncontrado = false;
		// Mensaje para mostrar la solución
		
		foreach ($aNumerosMultiplos as $multiplo) {
			
			if($iCont % $multiplo == 0){
				if(!$bMultiploEncontrado){
					$sMensaje .= "El número $iCont es multiplo de $multiplo";
					$bMultiploEncontrado = true;
				}
				else{
					$sMensaje .= ", $multiplo";
				}
			}
		}
		if($bMultiploEncontrado){
			$sMensaje .= "<br>";
		}

	$iCont++;
	}while($iCont <= $iRangoMaximo);

	echo $sMensaje;

}


////////////////////////  PARTE 2 - 


include('../inc/footer2.php');
?>