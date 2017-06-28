<?php 

$titulo="Dia de la semana";
$descripcion="En qué dia de la semana nos encontramos (switch).";

include('../inc/header2.php');
	
	$mensaje ="Dia de la semana: ";

	switch(date("w")){
		// "w" devuelve el día de la semana en formato número, domingo = 0.

		case 0:
			$mensaje .= "Domingo";
		break;
		case 1:
			$mensaje .= "Lunes";
		break;
		case 2:
			$mensaje .= "Martes";
		break;
		case 3:
			$mensaje .= "Miercoles";
		break;
		case 4:
			$mensaje .= "Jueves";
		break;
		case 5:
			$mensaje .= "Viernes";
		break;
		case 6:
			$mensaje .= "Sábado";
		break;
		default:
			$mensaje .= "...";
		break;
	}

	echo $mensaje;

include('../inc/footer2.php'); ?>
