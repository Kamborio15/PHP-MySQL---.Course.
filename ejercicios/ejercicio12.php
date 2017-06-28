<?php

$titulo="Número primo";
$descripcion="Para un número dado, comprobar si es primo.";

include('../inc/header2.php');
?>
<form id="esPrimo" action="#" method="POST">
	<p>Comprobar si un número es primo</p>
	<div>
		<label for="inputNumber">Numero entrada</label>
		<input type="text" name="inputNumber" id="inputNumber" required/>
	</div>
	
	<div><input class="btn btn-success" type="submit" name="enviar" id="enviar" value="Enviar"/></div>

</form>
<?php

// Realizamos la acción para el envio del formulario
if(isset($_POST) && !empty($_POST)){

	// Comprobamos cuantos divisores existen entre 1 y el numero ingresado
	$num = $_POST['inputNumber'];
	$cont = 0;
	$i = 1;
	while($i <= $num){
		if($num % $i == 0){
			$cont++;
		}
		if($cont > 2){
			// Paramos la ejecución una vez que sabemos que no es primo
			// Agilizamos la ejecución
			break;
		}
		$i++;	
	}

	// Un numero primo hará que $cont sólo valga 2, si es diferente de 2, no es primo
	// Los números 0 y 1 no se consideran primos
	if($num != 1){
		if($cont == 2){
			echo "El numero indicado es primo.";
		}
		else{
			echo "El numero indicado no es primo.";
		}
	}
	else{
		// El numero 1 no se considera primo
		echo "El número indicado no es primo.";
	}
}

include('../inc/footer2.php'); 
?>