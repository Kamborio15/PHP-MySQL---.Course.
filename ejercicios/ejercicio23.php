<?php
// Login que compruebe en archivo csv al usuario y permita acceso
// 2a parte - permitir registrarse al usuario


$titulo = "Login";
$descripcion = "Login y registro validando los datos en fichero externo .csv";

include('../inc/header2.php'); ?>

<form method="POST" action="#">
	<div>
		<label>
			Usuario
			<input type="text" id="username" name="username" required>
		</label>
	</div>
	<div>
		<label>
			Password
			<input type="password" id="pass" name="pass" required>
		</label>
	</div>

	<div>
		<input type="submit" class="btn btn-success" name="login" id="login" value="Login">
	</div>
	<br>
	<div>
		<!-- <p>Regístrese</p> -->
		<input type="submit" class="btn btn-primary" name="registro" id="registro" value="Registrar">
	</div>
</form>
<?php

include("../Utils/Utils.php");
$oUtils = new Utils();

// POST
if(isset($_POST) && !empty($_POST)){
	// Inicializar datos
	$sUsername = trim($_POST['username']);
	$sPassword = trim($_POST['pass']);
	$oFicheroUsuarios = file("usuarios.csv");
	
	// POST LOGIN
	if(isset($_POST['login']) && !empty($_POST['login'])){
		
		if($oUtils->bExisteUsuario($sUsername, $sPassword, $oFicheroUsuarios)){
			echo "<p>Bienvenido $sUsername</p>";
			//header('location: ../index.php');
		}
		else{
			echo "<p>Usuario no registrado</p>";
		}
	}

	// POST REGISTRAR
	if(isset($_POST['registro']) && !empty($_POST['registro'])){
		$bUsuarioYaRegistrado = false;
		$bUsuarioYaRegistrado = $oUtils->bExisteUsuario($sUsername, $sPassword, $oFicheroUsuarios);

		if($bUsuarioYaRegistrado){
			echo "<p>Usuario ya registrado</p>";
		}
		else{ // Crear registro en csv

			// Construir cadena
			$sDatosEntrada = "\"$sUsername\",\"$sPassword\";\n";

			// Abrir el fichero, "a" lo abre en modo escritura
			$gestor = fopen("usuarios.csv", "a");

			// Escribir en el fichero los datos
			fwrite($gestor, $sDatosEntrada);

			// Cerrar archivo
			fclose($gestor);

			echo "Registrado";

		}
	}
}

include('../inc/footer2.php');
?>