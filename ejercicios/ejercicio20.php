<?php // Control de array para campos checkbox

$titulo = "Datos de formularios con array";
$descripcion = "Controlar usos de arrays para datos de formulario";

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
		foreach ($_POST as $key => $value) {
			if(!empty($_POST[$key])){
				if(is_array($_POST[$key])){
					foreach ($_POST[$key] as $aDatos) {
						echo $key. ": " . $aDatos;
						echo "<br>";
					}
				}else{
					// else para prevenir error de array conversion al acceder al array de intereses
					echo $key. ": " . $_POST[$key];
					echo "<br>";
				}
			}
		}
	}
	
	include('../inc/footer2.php');
?>