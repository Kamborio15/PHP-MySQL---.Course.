<?php
$titulo = "Suma de números";
$descripcion = "Resultado de suma de números.";

include('../inc/header2.php'); 

	$resultado = "";
	$coche= "No";
	if(isset($_POST["coche"])){$coche=$_POST["coche"];}
	$resultado = $_POST['inputUno'] + $_POST['inputDos'];

	echo "El resultado es ".$resultado."\n". "y coche ".$coche;
	
?>
<br>
<a href="ejercicio1.php">Volver</a>

<?php include('../inc/footer2.php'); ?>

