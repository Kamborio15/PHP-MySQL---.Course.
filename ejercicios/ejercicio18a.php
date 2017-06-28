<?php 

$titulo = "Uso de funciones - Orden de strings";
$descripcion = "Uso de funciones para definir el orden de strings";

include('../inc/header2.php'); 
?>
	<p>Elegir el orden para mostrar dos cadenas</p>
	<form action="#" method="POST">
		<div>
			<label for="cadena1">Cadena 1</label>
			<input type="text" name="cadena1" id="cadena1" required>
			
		</div>
		<div>	
			<label for="cadena2">Cadena 2</label>
			<input type="text" name="cadena2" id="cadena2" required>
			
		</div>
		<div>
			<label>
		    	<input class="radio-inline" type="radio" name="posicion" id="before" value="0" checked>
		    	Anterior
		  	</label>
		  	<label>
		    	<input class="radio-inline" type="radio" name="posicion" id="after" value="1">
		    	Posterior
		  	</label>
			
		</div>
		<br>
		<div>
			<button class="btn btn-default" type="submit" name="enviar" id="enviar">Enviar</button>
		</div>
	</form>

<?php if(isset($_POST) && !empty($_POST)){ 
	
	if(isset($_POST["posicion"])){

		$cadena1 = $_POST["cadena1"];
		$cadena2 = $_POST["cadena2"];
		$posicion = $_POST["posicion"];

		echo ponerOrden($cadena1, $cadena2, $posicion);
	}
} 
// Ordenar las cadenas

function ponerOrden($cad1, $cad2, $posicion){
	$cadena ="";
	if($posicion == "1"){
		$cadena = $cad1 . " " . $cad2;
	}
	else{
		$cadena = $cad2 . " " . $cad1;
	}
	return $cadena;
}

include('../inc/footer2.php'); ?>