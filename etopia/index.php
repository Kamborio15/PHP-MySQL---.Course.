<?php

	$titulo ="";
	$descripcion="Index Etopia";?>

	<?php require_once("inc/conexion.inc.php");
	include("inc/header.php");

	// CONSULTAS
	$sProvincias = "select * from provincia";

	//execute query
	$resultadoProv = $mysqli->query($sProvincias);
	?>


		<label for="selectProvincias">Provincia</label>
		<select name="selectProvincias" id="selectProvincias">
			<option value="">Seleccione una provincia</option>
		<?php foreach ($resultadoProv as $value) {// Cargar datos en selector provincias?>
			<option value="<?php echo $value['id'];?>"><?php echo $value['provincia'];?></option>
		<?php }?>

		</select>

		<label for="selectLocalidades">Localidad</label>
		<select name="selectLocalidades" id="selectLocalidades">
			<option value="" selected>Seleccione una localidad</option>
			
		</select>	

<?php 
// close DB connection 
$mysqli->close();
include("inc/footer.php");
?>