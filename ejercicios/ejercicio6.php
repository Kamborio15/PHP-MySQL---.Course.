<?php 

$titulo="Validación en un fichero";
$descripcion='Subida de ficheros y variable $_FILES.';

include('../inc/header2.php'); ?>
	<!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
	<form enctype="multipart/form-data" method="POST">
	    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
	    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
	    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
	    Enviar este fichero: <input name="fichero_usuario" type="file" />
	    <input type="submit" name="enviar" value="Enviar fichero" />

	</form>
	
<?php 

	if(isset($_POST["enviar"])){
		
		//var_export($_FILES);
		echo "<p>Nombre del fichero: " . $_FILES["fichero_usuario"]["name"] . " </p>";
		echo "<p>Extensión del fichero: " . $_FILES["fichero_usuario"]["type"] . " </p>";
		echo "<p>Tamaño del fichero: " . $_FILES["fichero_usuario"]["size"] . " </p>";
		echo "<p>Nombre temp del fichero: " . $_FILES["fichero_usuario"]["tmp_name"] . " </p>";
		echo "<p>Error: " . $_FILES["fichero_usuario"]["error"] . " </p>";
		

		if(!empty($_FILES["fichero_usuario"])){
			$upload_dir = "uploads/";
			move_uploaded_file($_FILES["fichero_usuario"]["tmp_name"], $upload_dir.$_FILES["fichero_usuario"]["name"]);
		}
	}

include('../inc/footer2.php'); ?>

