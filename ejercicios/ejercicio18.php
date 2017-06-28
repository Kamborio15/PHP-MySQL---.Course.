<?php // Uso de funciones - Orden de strings

$titulo = "Uso de funciones - Orden de strings";
$descripcion = "Uso de funciones para definir el orden de strings";

include('../inc/header2.php'); 

function modificar($arg1, $arg2, $posicion = true){

	$cadena ="";
	$cadena = $arg1 . " " . $arg2;
	if(!$posicion){
		$cadena = $arg2 . " " . $arg1;
	}
	return $cadena;
}
function referencia(&$arg1, $posicion = true){

	$cadena ="Cadena anadida";
	if($posicion){
		$arg1 = $arg1 . " " . $cadena;
	}
	else{
		$arg1 = $cadena . " " . $arg1;
	}
}

$msg1 = "Zaragoza";
$msg2 = "Dinamica";

echo modificar($msg1, $msg2);
echo "<br>";
echo modificar($msg1, $msg2, false);

echo "<br>";
echo "<br>";
$cadena = $msg1." ".$msg2;

echo "Paso por referencia <br>";
echo "<br>";
echo $cadena;
echo "<br>";
referencia($cadena, true);
echo $cadena;
echo "<br>";
$cadena = $msg1." ".$msg2;
referencia($cadena, false);
echo $cadena;

include('../inc/footer2.php'); ?>