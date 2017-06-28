<?php
// Login que compruebe en bd al usuario y permita acceso
session_start();
include($_SERVER['DOCUMENT_ROOT']."/inc/conexion.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/inc/header2.php");
if(isset($_SESSION["id"])){
	// SESION INICIADA
	// Redireccion
	header("location: panel.php");

}elseif(isset($_POST['login'])){
	// POST LOGIN
	// Inicializar datos
	$sUsername = trim($_POST['username']);
	$sPassword = md5(trim($_POST['pass']));

	$sConsultaUsuario = "SELECT * FROM usuarios WHERE user = '".$sUsername."' AND password = '".$sPassword."'";
	
	$row=$mysqli->query($sConsultaUsuario);
	if($row->num_rows > 0){
		$registros = $row->fetch_assoc();
		$_SESSION["id"] = $registros["id"];// guardo el id de usuario en SESSION
		$_SESSION["username"] = $registros["user"];
		if(isset($_POST["remember"])){	//Registro de cookie si checkbox marcado
			// Registrar cookie
			setcookie("fkIdUsuario", $registros["id"], time()+300);
		}
		$_SESSION["usuarioValido"] = true;
		echo "Usuario correcto";
		header("location: panel.php");
	}
	else{
		$aDatosId = $mysqli->query($sConsultaUltimoIdRegistrado = "SELECT id FROM usuarios ORDER BY id DESC LIMIT 1")->fetch_assoc();
		$iUltimoId=$aDatosId["id"]+1;
		$sConsultaInsert = "INSERT INTO usuarios (id, user, password) VALUES (".$iUltimoId.", '".$_POST['username']."',  '".md5($_POST['pass'])."')";
		$mysqli->query($sConsultaInsert);
		$_SESSION["id"] = $iUltimoId;
		$_SESSION["username"] = $_POST["username"];
		setcookie("bCrearCarpeta", $_POST['username'], time()+300);
		//header("location: ejercicio27.php");
		header("location: panel.php");
	}
}
else{
	// FORMULARIO
	include($_SERVER['DOCUMENT_ROOT']."/Utils/Utils.php");
	$oUtils = new Utils();

	$titulo = "Login BD + Session";
	$descripcion = "Login y registro validando en BD y SESSION";

	?>

	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<label>
				Usuario
				<input type="text" class="form-control" id="username" name="username" required>
			</label>
		</div>
		<div class="form-group">
			<label>
				Password
				<input type="password" class="form-control" id="pass" name="pass" required>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkbox" id="remember" name="remember">
				Recordar usuario
			</label>
		</div>
		<div><p>**Si no está registrado, se le registrará con los datos introducidos en los campos requeridos</p></div>

		<div class="form-group">
			<input type="submit" class="btn btn-success" name="login" id="login" value="Login">
		</div>
		<br>
		<!-- <div>
			<input type="submit" class="btn btn-primary" name="registro" id="registro" value="Registrar">
		</div> -->
	</form>
<?php }
include($_SERVER['DOCUMENT_ROOT']."/inc/footer2.php");
?>