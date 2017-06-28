<?php 
$titulo = "Ejercicio 4";
$descripcion = "Formulario y resultados de respuesta";

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/header.php"); 
include($_SERVER['DOCUMENT_ROOT']."/examen/menu.php"); ?>


<form id="formulario4" action="#" method="POST">
	<div>
		<h1>¿Qué te parece el examen?</h1>
	</div>
	<div>
		<div class="radio">
			<label><input type="radio" id="option0" name="option" value="0" checked>Muy difícil</label>
		</div>
		<div class="radio">
			<label><input type="radio" id="option1" name="option" value="1">Difícil</label>
		</div>
		<div class="radio">
			<label><input type="radio" id="option2" name="option" value="2">Fácil</label>
		</div>
		<div class="radio">
			<label><input type="radio" id="option3" name="option" value="3">Muy fácil</label>
		</div>
	</div>
	<button class="btn btn-success" type="submit" id="boton" name="boton">Enviar</button>
	<button class="btn btn-primary" type="submit" id="visualizar" name="visualizar">Ver resultados</button>

</form>


<?php
if(isset($_POST['boton'])){
	// Recuperamos el value de la opción elegida
	$iOpcion = $_POST['option'];

	// Cargamos el archivo que tiene las estadísticas
	$aDatosEstadisticasArchivo = file("estadisticas.csv");

	$aDatosEstadisticas = array();
	foreach ($aDatosEstadisticasArchivo as $value) {
		//var_export($value);
		$aux = explode(",", $value);
		//var_export($aux);
		$aDatosEstadisticas[$aux[0]] = (int)rtrim($aux[1]);
	}

	// Sumamos la opción elegida a las estadísticas
	$aDatosEstadisticas[$iOpcion] = $aDatosEstadisticas[$iOpcion]+1;

	// Abrir fichero
	$gestor = fopen("estadisticas.csv", "r+");

	// Construir string para fichero
	$sResultado = "";

	foreach($aDatosEstadisticas as $indice => $opcion){
		$sResultado .= "$indice,$opcion";
		if($indice+1 != sizeof($aDatosEstadisticas)){
			$sResultado .= "\n";
		}
	}

	// Escribir
	fwrite($gestor, $sResultado);

	// Cerrar archivo
	fclose($gestor);
}
elseif(isset($_POST['visualizar'])){
	// MOSTRAR RESULTADOS

	$aDatosEstadisticasArchivo = file("estadisticas.csv");

	$aDatosEstadisticas = array();
	$iSumaTotalEstadisticas = 0;
	foreach ($aDatosEstadisticasArchivo as $value) {
		$aux = explode(",", $value);
		$aDatosEstadisticas[$aux[0]] = (int)rtrim($aux[1]);
		$iSumaTotalEstadisticas += $aDatosEstadisticas[$aux[0]]; // Total de respuestas registradas para %
	}

	// Abrir fichero
	$gestor = fopen("estadisticas.csv", "r");

	// Construir string para fichero
	$sResultado = '<div id="areaResultados">';

	foreach($aDatosEstadisticas as $indice => $opcion){
		$iResultado = 0;
		switch($indice){
			case 0:
				if($iSumaTotalEstadisticas > 0){
					$iResultado = round(($opcion/$iSumaTotalEstadisticas)*100);
				}
				$sResultado .= "<p>Muy difícil: $opcion / $iSumaTotalEstadisticas -- " . $iResultado . "%</p>";
			break;
			case 1:
				if($iSumaTotalEstadisticas > 0){
					$iResultado = round(($opcion/$iSumaTotalEstadisticas)*100);
				}
				$sResultado .= "<p>Difícil: $opcion / $iSumaTotalEstadisticas -- " . $iResultado . "%</p>";
			break;
			case 2:
				if($iSumaTotalEstadisticas > 0){
					$iResultado = round(($opcion/$iSumaTotalEstadisticas)*100);
				}
				$sResultado .= "<p>Fácil: $opcion / $iSumaTotalEstadisticas -- " . $iResultado . "%</p>";
			break;
			case 3:
				if($iSumaTotalEstadisticas > 0){
					$iResultado = round(($opcion/$iSumaTotalEstadisticas)*100);
				}
				$sResultado .= "<p>Muy fácil: $opcion / $iSumaTotalEstadisticas -- " . $iResultado . "%</p>";
			break;
		}
	}
	$sResultado .= '</div>';

	echo $sResultado;

}

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/footer.php"); ?>