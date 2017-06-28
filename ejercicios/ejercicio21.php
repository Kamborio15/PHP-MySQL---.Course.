<?php // Control de array para campos checkbox

$titulo = "Uso de each() y list()";
$descripcion = "Sustituir uso foreach por each y list";

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
				<input type="email" name="email" id="email">
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
			<button class="btn btn-success" type="submit" id="enviar">Enviar</button>
		</div>
	</form>

<?php
	// POST
	if(isset($_POST) && !empty($_POST)){
		$sMensaje = "";
		while(list($clave, $valor) = each($_POST)){
			if(is_array($valor)){
				$sMensaje .= "<p>$clave: ";
				while(list($key, $aDatos) = each($valor)){
					$sMensaje .= "$aDatos, ";
				}
				$sMensaje .= "</p>";
			}
			else{
				// else para prevenir error de array conversion al acceder al array de intereses
				if(!empty($valor)){
					$sMensaje .= "<p>$clave: $valor.</p>";
				}
			}
		}

		echo $sMensaje;
	}
	
	include('../inc/footer2.php');
?>