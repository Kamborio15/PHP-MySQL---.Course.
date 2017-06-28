<?php

$titulo = "Tabla del 2";
$descripcion = "Muestra la tabla de multiplicar del número 2.";

include('../inc/header2.php'); ?>
<table class="table table-stripe table-sm" border="1" style="width:50%;">
	
		<thead colspan="2">
			<tr>
				<td colspan="2" style="text-align: center;">Tabla del 2</td>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$sHTML = "";
			$iNumero = 2;
			$iCont = 0;
			do{
				// fila
				$sHTML .="<tr scope=\"row\">";

					// columna
					// Multiplicación
					$sHTML .="	<td class=\"col-md-3\"> $iNumero * $iCont = </td>";

					// Resultado
					$sHTML .="	<td class=\"col-md-3\">" . $iNumero * $iCont . "</td>";

				// Fin fila
				$sHTML .="</tr>";
				$iCont++;
			}while($iCont <= 10);
			
			echo $sHTML;
		?>
		</tbody>
</table>

<?php include('../inc/footer2.php'); ?>