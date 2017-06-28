<?php
session_start();

if(isset($_SESSION["usuarioValido"]) && $_SESSION["usuarioValido"]){
	// Pagina donde se visualizan todas las actividades.
	//Al hacer click en una, nos lleva a su página, con info detallada sobre ella.

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/header.php"); 
	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/conexion.inc.php"); 

	//SQL
	$sQuery = "select * from actividades";
	$aActividades = $mysqli->query($sQuery);

	$sContenido = '<div class="row">';

	if(!empty($aActividades)){

		foreach ($aActividades as $actividad) {
			$sContenido .= '<div id="$actividad["id"]" class="col-md-6 d-inline-block">';
			// titulo actividad - pasamos el id de la actividad por parámetro
				$sContenido .= '<p><a class="enlace" href="actividad.php?id='.$actividad["id"].'">'.$actividad["titulo"].'</a></p>';

				// imagen actividad
				$sContenido .= '<img src="/'.$actividad["foto"].'" title="'.$actividad["titulo"].'"
				 alt="'.$actividad["titulo"].'" class="img-responsive">';

				// desc corta
				$sContenido .= '<p>'.$actividad["descripcionCorta"].'</p>';

				// edad min  -  edad max
				$sContenido .= '<p>Edad entre '.$actividad["edadMin"].' y '.$actividad["edadMax"].' años.</p>';

			$sContenido .= '</div>';
		}
	}
	else{
		$sContenido .= '<p>No hay cursos disponibles</p>';
	}
	$sContenido .= '</div>';

	echo $sContenido;

	// FIN SQL
	$mysqli->close();

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/footer.php"); 
}
else{
	// Sesion no iniciada
	header("location: /loginbd/ejercicio27.php");
}
?> 