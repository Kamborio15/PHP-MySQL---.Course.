<?php session_start();

session_destroy();
setcookie("fkIdUsuario", null); 

header("location: ejercicio27.php");
?>