<?php

$titulo = "Elegir tablas";
$descripcion = "Seleccionar una o varias tablas a mostrar.";

include('../inc/header2.php'); ?>
	<p>Selecciona las tablas que quieras visualizar</p>
	<form action="#" method="POST">
		<div>
			<?php for ($i=1; $i <= 10; $i++){ ?>
				<label>
					<input type="checkbox" name="tabla[]" value="<?php echo $i; ?>">
					Tabla del <?php echo $i; ?>
				</label><br>
			<?php } ?>
		</div>
		<div>
			<button class="btn btn-default" type="submit" name="enviar" id="enviar">Enviar</button>
		</div>
	</form>

<?php if(isset($_POST) && !empty($_POST)){ 
	
	if(isset($_POST["tabla"])){
		foreach($_POST["tabla"] as $aTabla){ ?>
			<table class="table table-striped table-bordered table-condensed" style="width:80%; ">
			<caption><span class="text-center">Tabla del <?php echo $aTabla; ?></span></caption>
			<?php // Fila
			for ($i=0; $i <= 10; $i++) { ?>
				<!-- Celda de columna -->
				<td>
					<?php echo $aTabla ."x". $i ." = ".$aTabla*$i; ?>
				</td>
			<?php } ?>
			</table>
		<?php }
	}
} 
include('../inc/footer2.php'); ?>