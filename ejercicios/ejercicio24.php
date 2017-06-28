<?php

$titulo = "Paginador";
$descripcion = "Paginación de resultados (array_splice()), con visualización en tabla";

include("../inc/header2.php"); 

//////// CALCULO DIVISION DE RESULTADOS
if(isset($_GET['pagina'])){
	$iPagina = $_GET['pagina'];
}
else{
	$iPagina = 1;
}

$aDatos = file("usuarios.csv");

$iTotalRegistros = count($aDatos); // Obtener los resultados a mostrar
$iLimit = 3; // Limit para resultados por página

$iPaginaAnterior = $iPagina-1; // Valor de la pagina anterior
$iPaginaSiguiente = $iPagina+1; // Valor de la pagina siguiente
$iTotalPaginas = (int)ceil($iTotalRegistros/$iLimit); // Cuantas páginas se necesitan para todos los resultados

//////// -------------FIN CALCULO DIVISION DE RESULTADOS


//////// MOSTRAR DATOS EN TABLA

$inicio = ($iPagina*$iLimit)-$iLimit;
$fin = $iPagina*$iLimit;

$tabla = "";

$tabla .= '<table style="width:50%; text-align:center;" border="1">
		  <tr>
		    <th style="text-align:center;">Orden</th>
		    <th style="text-align:center;">Usuario</th> 
		    <th style="text-align:center;">Pass</th>
		  </tr>';

$icont = 0;

$aDatosMostrar = array_splice($aDatos, $inicio, $fin);

for ($i=$inicio; $i < $fin; $i++) {
	
	if($i < $iTotalRegistros){
		$aInformacion = explode(",", $aDatosMostrar[$icont]);

		for($j = 0; $j < 2; $j++){ // menor que 2 ya que el user y la pass son la posicion 0 y 1
			$aInformacion[$j] = str_replace("\"","", $aInformacion[$j]);
			$aInformacion[$j] = trim(str_replace(";","", $aInformacion[$j])); // quitamos el ; y el espacio al final
		}

		$tabla .= 
		'<tr>
			<td>'.($i+1).'</td>
		    <td>'.$aInformacion[0].'</td> 
		    <td>'.$aInformacion[1].'</td>

		</tr>';
	}
	$icont++;
	
}

$tabla .= '</table>';

echo $tabla;

//////// -------------FIN MOSTRAR DATOS EN TABLAS

//////// PAGINADOR
$sPaginador = "";

$sPaginador .= '
	<nav aria-label="Page navigation">
	  <ul class="pagination" style="display: flex;">';

if($iPagina > 1){
    $sPaginador .= '
    <li>
    	<a href="ejercicio24.php?pagina='.$iPaginaAnterior.'"
    	 aria-label="Previous">
        <span aria-hidden="true">Anterior</span>
      	</a>
  	</li>';
}

$sPaginador .= ' <p> Página '.$iPagina.' de '.$iTotalPaginas.' </p> ';

if($iPagina < $iTotalPaginas){
    $sPaginador .= '
    <li>
    	<a href="ejercicio24.php?pagina='.$iPaginaSiguiente.'"
    	 aria-label="Next">
        <span aria-hidden="true">Siguiente</span>
      	</a>
  	</li>';
}

$sPaginador .= '</ul></nav>';
	    
$sPaginador .= "Mostrando $iTotalRegistros resultados.<br>";
$sPaginador .= "$iLimit resultados por página.<br>";
echo $sPaginador;
include("../inc/footer2.php"); ?>

