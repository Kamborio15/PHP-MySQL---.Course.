<?php

$titulo = "Creación de arrays";
$descripcion = "Array indexado y array asociativo";

include('../inc/header2.php');

//////////////////////////////////////////
// Array Indexado
echo "Array indexado: <br>";
$aDias[] = "Lunes";
$aDias[] = "Martes";
$aDias[] = "Miércoles";
$aDias[] = "Jueves";
$aDias[] = "Viernes";
$aDias[] = "Sábado";
$aDias[] = "Domingo";

foreach ($aDias as $dia) {
	echo $dia. " ";
}

echo "<br><br>";
echo "Array asociativo: <br>";

//////////////////////////////////////////
// Array Asociativo
$aAsignaturas = array(
	"titulo" => "Bases de datos",
	"nivel" => "Primero",
	"duracion" => "200 h.",
	"profesor" => "Lolo Lolez"
);


foreach ($aAsignaturas as $apartado => $informacion) {
	echo ucwords($apartado) . ": " . $informacion . ".<br>";
}

//////////////////////////////////////////
// Array de meses y dias, y con date() mostrar la fecha actual.
echo "<br>";
echo "Fecha actual a través de datos en array y date() <br>";

$aMeses[] = "Enero";
$aMeses[] = "Febrero";
$aMeses[] = "Marzo";
$aMeses[] = "Abril";
$aMeses[] = "Mayo";
$aMeses[] = "Junio";
$aMeses[] = "Julio";
$aMeses[] = "Agosto";
$aMeses[] = "Septiembre";
$aMeses[] = "Octubre";
$aMeses[] = "Noviembre";
$aMeses[] = "Diciembre";
	
$aDiasSemana[] = "Lunes";
$aDiasSemana[] = "Martes";
$aDiasSemana[] = "Miércoles";
$aDiasSemana[] = "Jueves";
$aDiasSemana[] = "Viernes";
$aDiasSemana[] = "Sábado";
$aDiasSemana[] = "Domingo";


$iDiaSemana = date("N");
$iDiaMes = date("d");
$iMes = date("n");
$iAnio = date("o");

echo "<span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"></span>  ";
echo $aDiasSemana[$iDiaSemana-1].", " . $iDiaMes . " de " . $aMeses[$iMes-1] . " de " . $iAnio;

echo "<br><br>";
echo "setLocale y strftime()<br>";
setlocale(LC_ALL, "es_ES");
//echo strftime("%A, %e de %B de %G");
echo strftime("%A, %d de %B de %Y");

include('../inc/footer2.php');
?>