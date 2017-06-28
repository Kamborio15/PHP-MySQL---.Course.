<?php
// Login que compruebe en bd al usuario y permita acceso
session_start();
$titulo = "Panel Cookie y Session";
$descripcion = "Control uso Cookies o Session para acceso al panel";
include($_SERVER['DOCUMENT_ROOT']."/inc/conexion.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/inc/header2.php");
/* CODIGO ORIGINAL ANTES DE VER/LISTAR DIRECTORIOS
if(isset($_COOKIE["fkIdUsuario"])){
	$_SESSION["id"] = $_COOKIE["fkIdUsuario"];

	//header("location: index.php");
}elseif(isset($_SESSION["id"])){

	//header("location: index.php");

}else{
	$titulo = "Panel Cookie y Session";
	$descripcion = "Control uso Cookies o Session para acceso al panel";

	echo "No hay Cookies almacenadas o sesión iniciada.";

}
*/
$directorio = $_SERVER["DOCUMENT_ROOT"]."/loginbd/";
if(isset($_SESSION["id"]) && isset($_COOKIE["bCrearCarpeta"])){


// Crear carpeta del usuario cuando se registre
	$directorio .= $_SESSION["username"];
	mkdir($directorio, 0755);
	//var_export($_SERVER["DOCUMENT_ROOT"]);

	// Eliminar cookie ya que la carpeta del usuario ya ha sido creada
	//setcookie("bCrearCarpeta", null);

}
elseif(isset($_SESSION["id"])){

// Usuario ya registrado y carpeta creada
	$directorio .= $_SESSION["username"];
	echo "Directorio de : ".basename($directorio)."<br>";

	$aFicheros = scandir($directorio);
	var_export($aFicheros); exit();
	
$sTablaHTML = '<table id="TablaFicherosDirectorio" class="table">';

	$sTablaHTML .= '<thead>
						<tr>
							<th> </th>
							<th>Nombre</th>
							<th>Tamaño</th>
							<th>Tipo</th>
						</tr>
					</thead>';

	$sTablaHTML .= '<tbody>';
	foreach ($ficheros as $indice => $fichero) {
	var_export($fichero);
		$sTablaHTML .= '<tr>
							<td>'.is_dir($fichero) ? '<span class="glyphicon glyphicon-file"></span>' : (is_dir($fichero) ? '<span class="glyphicon glyphicon-folder-open"></span>' : '<span></span>') .'</td>
							<td> </td>
							<td>'.is_file($fichero) ? filesize($fichero) :''.'</td>
							<td>'.is_file($fichero) ? filetype($fichero) :''.'</td>';
		$sTablaHTML .= '</tr>';
	}

	$sTablaHTML .= '</tbody>';
$sTablaHTML .= '</table>';

echo $sTablaHTML;

}else{

	echo "No hay Cookies almacenadas o sesión iniciada.";

}

include($_SERVER['DOCUMENT_ROOT']."/inc/footer2.php");

?>