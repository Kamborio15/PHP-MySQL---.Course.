<?php

$titulo = "Suma de impares entre 0 y 10";
$descripcion = "Muestra la suma de impares entre 0 y 10";

include('../inc/header2.php'); 
// Sumar todos los números impares entre 0 y 10

echo "Sumar todos los números impares entre 0 y 10.<br><br>";

$num = 0;
$total = 0;
$sNumerosImpares = "";
do{
	if($num % 2 != 0){
		$total += $num;
		$sNumerosImpares .= "$num ";
	}
	$num++;

}while($num <= 10);

echo "La suma de los números impares entre 0 y 10 ($sNumerosImpares) es $total";

include('../inc/footer2.php'); 
?>
