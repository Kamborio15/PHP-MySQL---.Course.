<?php
// Funcion mail() de php.

$titulo="Uso de mail()";
$descripcion="Envío de mail con la función mail() de la librería de PHP";

include('../inc/header2.php'); 

echo "Se ha enviado un mail a la direccion deliacampo@gmail.com.";
mail("deliacampo@gmail.com", "Test mail()", "Prueba de envio con mail()");

include('../inc/footer2.php'); 