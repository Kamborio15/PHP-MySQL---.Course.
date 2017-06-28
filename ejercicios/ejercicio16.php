<?php

$titulo = "Tablas del 1 al 10";
$descripcion = "Muestra las tablas de multiplicar del 1 al 10";

include('../inc/header2.php'); ?>

	<table class="table table-striped table-bordered table-condensed" style="width:80%; ">
	<caption>
		<span class="text-center">Tablas de multiplicar del 1 al 10</span>
	</caption>
	<thead>
		<tr>
			<?php 
			// Cabecera
			for ($i=1; $i <= 10; $i++) { ?>
				
				<th>Tabla del <?php echo $i; ?></th>
			
			<?php } ?>
		</tr>
	</thead>

	<?php
	// Fila
	for ($i=0; $i <= 10; $i++) { ?>
		<tr>
			<?php // Celda de columna
			for ($j=1; $j <= 10; $j++) { ?>
				<td>
					<?php echo "$j x $i = ".$i*$j; ?>
				</td>
			<?php } ?>
		</tr>
		
		<?php
		//echo "<br>";
	}

	?>
	</table>
	
<?php include('../inc/footer2.php'); ?>