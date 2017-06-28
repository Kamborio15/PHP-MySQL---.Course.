<?php

$titulo = "Ejercicio 3";
$descripcion = "Sumatorio de un número aleatorio (entre 1 y 20)";

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/header.php"); 
include($_SERVER['DOCUMENT_ROOT']."/examen/menu.php");

// Generar número aleatorio entre 1 y 20
$iNum = rand(1, 20);

// Sumatorio desde 1 hasta aleatorio
$sOperacionesRealizadas = "";
$iTotal = 0;
for ($i=1; $i <= $iNum; $i++) { 
	if($i>1){
		// Añadimos el + despues de cada número a partir del 1
		$sOperacionesRealizadas .= "+";
	}
	$sOperacionesRealizadas .= $i;
	$iTotal += $i;
}

// Mostrar resultado
echo "Número generado: " . $iNum . "<br>";
echo $sOperacionesRealizadas . " = " . $iTotal;

include($_SERVER['DOCUMENT_ROOT']."/examen/inc/footer.php"); ?>