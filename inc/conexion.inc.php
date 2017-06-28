<?php
$mysqli = new mysqli("localhost", "root", "", "etopia"); // LOCALHOST

// Connection error
if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$mysqli->query("SET NAMES utf8");

//echo "conectado";
//$mysqli->close();
?>