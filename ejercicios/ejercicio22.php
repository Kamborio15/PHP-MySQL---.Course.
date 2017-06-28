<?php // Control de array para campos checkbox

$titulo = "Mostrar textos random";
$descripcion = "Mostrar contenido de párrafos en función del número elegido.";

include('../inc/header2.php'); ?>
	<form action="#" method="POST">
		<div>
			<label>
				Cantidad de líneas
				<input type="number" name="cantidad" id="cantidad" min="0">
			</label>
		</div>
		<div>
			<button class="btn btn-success" type="submit" id="enviar">Enviar</button>
		</div>
	</form>

<?php
	// POST
	if(isset($_POST) && !empty($_POST)){
		define("IDATOSENARRAY","8");
		$iNum = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : 0 ;
		$sLoreIpsum = array(
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 
			"Mauris congue libero facilisis velit gravida lacinia.", 
			"Mauris sed feugiat orci, et auctor elit.", 
			"Sed luctus odio lorem, vitae vestibulum nunc blandit eget.", 
			"Vestibulum sit amet sapien a turpis bibendum consectetur et non mauris.", 
			"Integer odio magna, faucibus eu vestibulum id, efficitur viverra elit.", 
			"Duis magna mauris, elementum ut tellus laoreet, ullamcorper tincidunt massa.", 
			"Nunc facilisis dapibus mauris quis dapibus.");
		shuffle($sLoreIpsum);
	
		$sResultado = "";
		// Calculamos cuantas repeticiones hay que hacer si el número es mayor al contenido del array
		$iRepeticiones = 0;
		// Calculamos el resto que añadir si el número es mayor al contenido del array
		$iResto = 0;
		$iCAntArray = IDATOSENARRAY;
		$iCont = 0;

		if($iNum > 0){
			if($iNum > $iCAntArray){
				// Entrada mayor que array
				$iAux = $iNum / $iCAntArray;
				$iRepeticiones = (int)$iAux;
				$iResto = $iNum % $iCAntArray;

				for ($i=0; $i < $iRepeticiones; $i++) { 
					for ($j=0; $j < $iCAntArray; $j++) { 
						$iCont++;
						$sResultado .= "<p>$iCont - $sLoreIpsum[$j]</p>";
					}
				}
				for ($i=0; $i < $iResto; $i++) { 
					$iCont++;
					$sResultado .= "<p>$iCont - $sLoreIpsum[$i]</p>";
				}
			}
			elseif($iNum <= $iCAntArray){
				// Entrada igual que array
				for ($i=0; $i < $iNum; $i++) { 
					$iCont++;
					$sResultado .= "<p>$iCont - $sLoreIpsum[$i]</p>";
				}
			}
		}
		else{
			$sResultado = "Debe introducir valores superiores a 0.";
		}

	echo $sResultado;
}

include('../inc/footer2.php'); ?>