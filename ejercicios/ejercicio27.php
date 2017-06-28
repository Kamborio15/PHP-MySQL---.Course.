<?php
// Login que compruebe en archivo csv al usuario y permita acceso
// 2a parte - permitir registrarse al usuario


$titulo = "Login BD + Session";
$descripcion = "Login y registro validando en BD y SESSION";

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
	
	// POST LOGIN
	if(isset($_POST['login']) && !empty($_POST['login'])){
		
		




		
	}
}

include('../inc/footer2.php');
?>