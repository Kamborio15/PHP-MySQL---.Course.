<?php // Control de array para campos checkbox

$titulo = "Array de checkbox";
$descripcion = "Uso de checkboxes como array.";

include('../inc/header2.php'); ?>
	<form action="#" method="POST">
		<div>
			<label>
				Nombre
				<input type="text" name="nombre" id="nombre">
			</label>
		</div>
		<div>
			<label>
				Dirección de correo
				<input type="email" name="direccionemail" id="direccionemail">
			</label>
		</div>	
		<div>
			<p>Áreas de interés</p>
			<label>
				<input type="checkbox" name="interes[]" id="interes1" value="Deportes">
				Deportes
			</label>
			<label>
				<input type="checkbox" name="interes[]" id="interes2" value="Noticias">
				Noticias
			</label>
			<label>
				<input type="checkbox" name="interes[]" id="interes2" value="Sociedad">
				Sociedad
			</label>
		</div>

		<div>
			<input class="btn btn-success" type="submit" name="enviar" id="enviar" value="Enviar"/>
		</div>
	</form>

<?php
	// POST

	if(isset($_POST) && !empty($_POST)){
		// Recogemos los valores de interés que hayan marcado, si no lo definimos array()
		$aIntereses = (isset($_POST["interes"])) ? $_POST["interes"] : array();
			
		$sInfoIntereses = "Tus intereses son: ";
		foreach($aIntereses as $interes){
			$sInfoIntereses .= $interes.", ";
		}

		// Modificamos el mensaje para que se muestren los carácteres coherentes
//////////////////////// SE PUEDE MEJORAR
		// Cambiar coma por punto del final
		$iLongitudString = strlen($sInfoIntereses);
		$sInfoIntereses = substr($sInfoIntereses, 0, $iLongitudString-2);
		$sInfoIntereses .= ".";

		if(sizeof($aIntereses) > 1){
			// Cambiar ultima coma por " y "
			$sInfoIntereses = substr_replace($sInfoIntereses, ' y '.end($aIntereses), strrpos($sInfoIntereses, ','));
			//$sInfoIntereses = str_replace(',', ' y ', $sInfoIntereses);
			$sInfoIntereses .= ".";
		}
//////////////////////// FIN SE PUEDE MEJORAR
		// No han elegido ninguna opción
		if(empty($aIntereses)){
			$sInfoIntereses = "No has seleccionado intereses.";
		}

		echo $sInfoIntereses;

	}
	
include('../inc/footer2.php');
?>