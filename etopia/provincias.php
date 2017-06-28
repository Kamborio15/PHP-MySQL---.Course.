<?php

require_once("inc/conexion.inc.php");

	if(isset($_POST['fkIdProvincia'])){
		$iIdProvincia = $_POST['fkIdProvincia'];

		$consulta = "select * from localidad where fkIdProvincia = $iIdProvincia";

		$resultado = $mysqli->query($consulta);

		$respuesta = '<option value="" selected>Seleccione una localidad</option>';

		foreach ($resultado as $value) {
			$respuesta .= '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
		}

		echo $respuesta;
	}
	$mysqli->close();

?>