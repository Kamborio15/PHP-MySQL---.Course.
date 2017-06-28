<?php 

$titulo = "Validación de formulario con jquery y HTML5, + AJAX Post";
$descripcion = "Uso de jquery validation para formularios";

if(isset($_POST) && !empty($_POST)){
// POST
	if(empty($_POST['nombreForm']) ||
		empty($_POST['emailForm']) ||
		empty($_POST['commentForm'])){
		echo "Datos no completados";
		return false;
	}

	$nombre = strip_tags( htmlspecialchars($_POST['nombreForm']) );
	$email = strip_tags( htmlspecialchars($_POST['emailForm']) );
	$comentario = strip_tags( htmlspecialchars($_POST['commentForm']) );

	// Respuesta
	echo "Este mensaje se ha generado en un post de AJAX con los datos del Form.<br>
		Su nombre es \"" . $nombre . "\" y su email es \"" . $email . "\".<br>
		Su comentario es \"" . $comentario . "\".";
		// validacion.js
		return true;
}
else{

	include('../inc/header2.php'); 
?>

	<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
	<!-- <script src="../js/jquery.js"></script> -->
	<script src="../js/jquery.validate.min.js"></script>
	<script src="../js/validacion.js"></script>

	<form action="#" method="post" style="width:50%;" id="formulario26">

		<div>
			<p>Validación de datos con jQuery validate script + post Ajax</p>
		</div>
		<div class="form-group">
			<label for="username">Nombre:</label>
			<input class="form-control" id="username" name="username" required>
		</div>
		<!-- <div class="form-group">
			<label for="password">Password:</label>
			<input class="form-control" id="password" name="password" required>
		</div> -->
		<div class="form-group">
			<label for="email">Correo electrónico:</label>
			<input class="form-control"  id="email" name="email" type="email" required>
		</div>
		<div class="form-group">
			<label for="comment">Comentarios:</label>
			<textarea class="form-control"  rows="4" cols="50" id="comment" name="comment"></textarea>
		</div>
		
		<input class="btn btn-small" name="enviar" id="enviar" type="submit" value="Enviar datos"/>
	</form>
<?php 

include('../inc/footer2.php'); 
}

?>
