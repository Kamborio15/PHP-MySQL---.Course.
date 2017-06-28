<?php 

$titulo = "Formulario para envio email con HTML incluido. Uso para Gmail";
$descripcion = "Rellenar el formulario y envio de email con código HTML para la visualización en el correo";

include('../inc/header2.php'); ?>

<form action="#" method="post" enctype="multipart/form-data" style="width:40%;">

	<div>
		<p>Rellene los datos para envío del formulario.</p>
	</div>
	<div class="form-group">
		<label for="inputNombre">Nombre:</label>
		<input class="form-control" id="inputNombre" name="inputNombre" required>
	</div>
	<div class="form-group">
		<label for="inputMail">Correo electrónico:</label>
		<input class="form-control"  id="inputMail" name="inputMail" type="email" required>
	</div>
	<div class="form-group">
		<label for="inputComment">Comentarios:</label>
		<textarea class="form-control"  rows="4" cols="50" id="inputComment" name="inputComment"></textarea>
	</div>
	<div class="form-group">
    	Enviar este fichero: <input name="foto_adjunto" type="file" />
	</div>
	<br><button class="btn btn-small" name="enviar" id="enviar" type="submit">Enviar datos</button>
</form>
<?php include('../inc/footer2.php'); ?>


<?php

	if(isset($_POST) && !empty($_POST)){
		// POST - DATOS

		// Construimos mensaje con los datos del formulario
		$bMensajeEnviado = false;
		$sNombre = $_POST['inputNombre'];
		$sMail = $_POST['inputMail'];
		$sComments = $_POST['inputComment'];
		$sSubject = "Prueba";

		$cabeceras = 'From: webmaster@example.com' . "\r\n" .
			'Reply-To: '. $sMail . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-Type: text/html; charset=UTF-8\r\n' . "\r\n";

		$sContenido = "<strong>Nombre de usuario:</strong> " . $sNombre . ",<br>
		<strong>Correo electrónico:</strong> " . $sMail . ",<br>
		<strong>Comentarios:</strong> " . $sComments . " .";

		// POST - ADJUNTOS
		if(isset($_FILES) && !empty($_FILES)){
			// Recuperamos la foto que se ha adjuntado en el form
			$sCarpeta ="images/";
			$sCarpetaImagenesRaiz = "ejercicios/images/";
			// sURL -> Ruta del servidor de internet (para acceso a archivos adjuntos en linea)
			$sUrl = "http://dlapuente.sallende.zaragozadinamica.net/";

			// Movemos el fichero subido desde $_FILES hasta la nueva ubicación en la carpeta del servidor
			move_uploaded_file($_FILES['foto_adjunto']['tmp_name'], $sCarpeta.$_FILES['foto_adjunto']['name']);
			// TRAMPA (src de img en internet)  //$sContenido .= '<img src="https://s1.significados.com/foto/shutterstock-134400179_sm.jpg" />';
			$sContenido .= '<br><img src="'.$sUrl.$sCarpetaImagenesRaiz.$_FILES["foto_adjunto"]["name"].'" />';
			// La url del elemento src debe ser la url del sitio con toda la jerarquía de carpetas hasta
			// donde se ubica el fichero
		}

		// Control de error de la función mail() para avisar al cliente
		$bMensajeEnviado = mail($sMail, $sSubject, $sContenido, $cabeceras);

		if($bMensajeEnviado){
		// Correo preparado para envio
			echo "El mensaje se ha enviado con éxito. Compruebe su bandeja de entrada (o spam) para comprobar sus datos.";
		}
	}
?>