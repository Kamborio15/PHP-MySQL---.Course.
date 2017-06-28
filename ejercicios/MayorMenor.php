<?php 

$titulo="Mayor o menor";
$descripcion="Introduce dos cantidades y determina si es mayor o menor";

include('../inc/header2.php');
	$numero1 = $_POST['inputUno'];
	$numero2 = $_POST['inputDos'];

	$bNumerosCorrectos = false;
	if(($numero1 != "") && ($numero2 != "")){
		$bNumerosCorrectos = true;
	}

	if(isset($numero1) && isset($numero2) && $bNumerosCorrectos){
		// Datos validados
		if($numero1 > $numero2){
			echo 'El primer valor ' . $numero1 . ' es mayor que el segundo valor ' . $numero2 . '.';
		}elseif($numero1 < $numero2){
			echo 'El primer valor ' . $numero1 . ' es menor que el segundo valor ' . $numero2 . '.';
		}else{
			echo 'Ambos números son iguales';
		}

	}
	else{
		// Error algún campo vacio
		echo "Se ha producido un error. Debe introducir valores en ambos campos.";
	} ?>

<br>
<a href="/ejercicios/ejercicio3.php">Volver</a>

<?php include('../inc/footer2.php'); ?>
