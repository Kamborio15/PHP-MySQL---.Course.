<?php 
$titulo = "Convertir pesetas.";
$descripcion = "Resultado de convertir pesetas a euros.";

include('../inc/header2.php');

define("EURO", 166.386);
$iEuros = "";

$iPesetas = $_POST['inputPeseta'];
$iEuros = $iPesetas / EURO;

if($iPesetas != ""){
	echo $iPesetas .' pesetas equivalen a '. number_format($iEuros, 2) .' Euros.';
}
else{
	echo "Introduzca una cantidad.";
} ?>

<a href="ejercicio2.php">Volver</a>
<?php include('../inc/footer2.php'); ?>
	