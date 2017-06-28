<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/conexion.inc.php");

$select = "SELECT precio FROM semanas INNER JOIN plazas ON plazas.fkIdSemana = semanas.id WHERE plazas.id =".$_POST["idPlaza"]."";
$row = $mysqli->query($select)->fetch_assoc();

echo $row["precio"];


// Datos del post para recordar los datos del formulario tras el Paypal
if(isset($_POST["data"])){

/*$campos = array();
parse_str($_POST["data"], $campos);

//print_r($campos);
	foreach ($campos as $clave=>$valor) {
		setcookie($clave, $valor , time()+3600);
	}
}*/
//echo "hola";
$mysqli->close();
?>