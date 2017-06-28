<?php

$titulo = "Ejercicio 2";
$descripcion = "Selector de operacion";

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/header.php"); 
include($_SERVER['DOCUMENT_ROOT']."/examen/menu.php"); ?>

<form id="formulario2" method="POST" action="#">
	<div id="numerador1">
		<label>Número 1</label>
		<input type="text" id="numero1" name="numero1" placeholder="Número 1" required/>
	</div>
	<div id="numerador2">
		<label>Número 2</label>
		<input type="text" id="numero2" name="numero2" placeholder="Número 2" required/>
	</div>
	<p>*Situe el cursos encima de los operadores para ver las opciones</p>
	<div id="selector">
		<div class="checkbox" title="Suma">
			<label><input type="checkbox" id="checkSuma" name="operador[]" value="+" >Suma</label>
		</div>
		<div class="checkbox" title="Resta">
			<label><input type="checkbox" id="checkResta" name="operador[]" value="-">Resta</label>
		</div>
		<div class="checkbox" title="Producto">
			<label><input type="checkbox" id="checkProducto" name="operador[]" value="*">Multiplica</label>
		</div>
		<div class="checkbox" title="El número 1 es la base y el número 2 es el exponente">
			<label><input type="checkbox" id="checkPotencia" name="operador[]" value="^">Potencia</label>
		</div>
		<div class="checkbox" title="Módulo de división">
			<label><input type="checkbox" id="checkModulo" name="operador[]" value="%">Módulo</label>
		</div>
	</div>
	<button class="btn btn-success" type="submit" id="botonEnviar" name="botonEnviar">Calcular</button>

</form>

<?php 
// POST
if(isset($_POST['botonEnviar'])){

	$numero1 = (int)$_POST['numero1'];
	$numero2 = (int)$_POST['numero2'];

	$sResultado = "";
	$iResultado = 0;

	$aOperaciones = (!empty($_POST['operador'])) ? $_POST['operador'] : array();

	foreach ($aOperaciones as $value) {

		switch ($value) {
			case '+':
				// Suma
				$iResultado = $numero1 + $numero2;
				$sResultado .= "<p>El resultado de la suma de $numero1 y $numero2 es: $iResultado</p>";
				break;

			case '-':
				// Resta
				$iResultado = $numero1 - $numero2;
				$sResultado .= "<p>El resultado de la resta de $numero1 y $numero2 es: $iResultado</p>";
				break;

			case '*':
				// Multiplicación
				$iResultado = $numero1 * $numero2;
				$sResultado .= "<p>El resultado del producto de $numero1 y $numero2 es: $iResultado</p>";
				break;

			case '^':
				// Potencia
				$iResultado = pow($numero1, $numero2);
				$sResultado .= "<p>La potencia de base $numero1 y exponente $numero2 es: $iResultado</p>";
				break;

			case '%':
				// Módulo de división
				$iResultado = $numero1 % $numero2;
				$sResultado .= "<p>El resto de la división entre $numero1 y $numero2 es: $iResultado</p>";
				break;
		}
	}

	if(empty($aOperaciones)){
		$sResultado = "No ha seleccionado ningún operador para el cálculo.";	
	}
	echo $sResultado;

}

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/footer.php"); ?>