<?php

$titulo="Números del 1 al 50 e impares del 51 al 1";
$descripcion="Muesta los números del 1 al 50 e impares del 51 al 1";

include('../inc/header2.php');

// Escribir todos los números del 1 al 50.
$i = 1;
echo "Escribir todos los numeros del 1 al 50.<br>";

while($i >= 0 && $i <= 50){

	echo $i++."\n";

}

echo "<br><br>";

// Escribir números impares del 51 al 1.
$o = 51;

echo "Escribir numeros impares del 51 al 1.<br> ";
while($o > 1 && $o <= 51){

	echo $o."\n";
	$o-=2;

}
include('../inc/footer2.php');
?>
