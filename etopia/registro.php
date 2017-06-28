<?php 
session_start();
if(isset($_SESSION["usuarioValido"]) && $_SESSION["usuarioValido"]){

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/conexion.inc.php"); 
	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/header.php"); 
	//echo "hola";

	$insertPadre="";
	$insertHijo="";
	$insertInscripcion="";
	// Recuperamos las plazas disponibles para controlar si se puede inscribir o no
	$sConsultaPlazas = 'SELECT * FROM plazas where id = '.$_POST["selectActividades"].'';
	$row = $mysqli->query($sConsultaPlazas);
	$aPlazas = $row->fetch_assoc();
	$bPlazasDisponibles=true;
	if($aPlazas["plazasOcupadas"] >= $aPlazas["numPlazas"]){
		$bPlazasDisponibles=false;
	}

	// Recuperamos el precio de la semana elegida
	$sConsultaPrecio = 'SELECT precio FROM semanas where id = '.$aPlazas["fkIdSemana"].'';
	$row = $mysqli->query($sConsultaPrecio);
	$aPrecio = $row->fetch_assoc();

	// Recuperar ultimo id tabla padres
	$sConsultaUltimoIdPadre = "SELECT id FROM padres ORDER BY id DESC LIMIT 1";
	$row = $mysqli->query($sConsultaUltimoIdPadre)->fetch_assoc();
	$iIdUltimoRegistroPadre = isset($row["id"]) ? $row["id"] : 0;
	$iIdUltimoRegistroPadre += 1;

	// Recuperar ultimo id tabla ninos
	$sConsultaUltimoIdNino = "SELECT id FROM ninos ORDER BY id DESC LIMIT 1";
	$row = $mysqli->query($sConsultaUltimoIdNino)->fetch_assoc();
	$iIdUltimoRegistroNino = isset($row["id"]) ? $row["id"] : 0;
	$iIdUltimoRegistroNino += 1;

	// Recuperar ultimo id tabla inscripcion
	$sConsultaUltimoIdInscripcion = "SELECT id FROM inscripcion ORDER BY id DESC LIMIT 1";
	$row = $mysqli->query($sConsultaUltimoIdInscripcion)->fetch_assoc();
	$iIdUltimoRegistroInscripcion = isset($row["id"]) ? $row["id"] : 0;
	$iIdUltimoRegistroInscripcion += 1;

	$precioTotal = 0;
	$fecha1 = explode("/", $_POST['inputFechaNacimientoNino']);
	$fechaNacimientoNino = $fecha1[2] .'-'.$fecha1[0].'-'.$fecha1[1];
	//var_export($aPlazas);
	//var_export($aPrecio);
	//echo "$iIdUltimoRegistroPadre-$iIdUltimoRegistroNino-$iIdUltimoRegistroInscripcion";

	if (mysqli_connect_errno()) {
	    printf("Error de conexión: %s\n", mysqli_connect_error());
	    exit();
	} else {
		//var_export($_POST);

		///////////////////////////////////////
		///BLOQUE INSERT MANUAL DATOS PRUEBA///
		///////////////////////////////////////
		/*$insertPadre="INSERT INTO `padres`(`id`, `nombre`, `email`, `telefono`, `domicilio`, `CP`, `fkIdProvincia`, `fkIdLocalidad`) 
		VALUES (1,'Lolo Lolez','lolo@gmail.com','666555111','Calle Lolez 10 1A',50001,50,1);";
		$mysqli->query($insertPadre);
		$iIdPadre=$mysqli->insert_id;
		if($iIdPadre){
			$insertHijo="INSERT INTO `ninos`(`id`, `nombre`, `fecha_nac`, `sexo`, `talla`, `fkIdCurso`, `observaciones`, `fkIdPadre`) 
			VALUES (1,'Lalo Lolez','2010-06-01','M','L',1,'',$iIdPadre);";
			$mysqli->query($insertHijo);
			$iIdNino=$mysqli->insert_id;
			if($iIdNino){
				$insertInscripcion="INSERT INTO `inscripcion`(`id`, `fecha`, `fkIdNino`, `fkIdActividad`, `fkIdSemana`, `comedor`, `madrugador`, `precioTotal`) 
				VALUES (1,'2017-06-04',$iIdNino,1,1,0,0,110);";
				$mysqli->query($insertInscripcion);

				echo '<p>Inscripción realizada con exito.</p>';
				
			}
		}*/

		///////////////////////////////////////
		//////BLOQUE INSERT  DATOS $_POST//////
		///////////////////////////////////////
		if($bPlazasDisponibles){
			
			//$mysqli->autocommit(FALSE);

			//$mysqli->begin_transaction();

			// INSERTS
			$observaciones = isset($_POST["inputObservacionesNino"]) ? $_POST["inputObservacionesNino"] : "";
			$nombreCompletoPadre = $_POST['inputNombrePadre'].' '.$_POST['inputApellidosPadre'];
			$insertPadre="INSERT INTO `padres`(`id`, `nombre`, `email`, `telefono`, `domicilio`, `CP`, `fkIdProvincia`, `fkIdLocalidad`) 
			VALUES (".$iIdUltimoRegistroPadre.",'".$nombreCompletoPadre."','".$_POST['inputEmailPadre']."',".$_POST['inputTelefonoPadre'].",'".$_POST['inputDireccionPadre']."',".$_POST['inputCodigoPostalPadre'].",".$_POST['selectProvincias'].",".$_POST['selectLocalidades'].");";
			$mysqli->query($insertPadre);
			$iIdPadre=$mysqli->insert_id;
			if($iIdPadre){
				$fechaNacimientoNino = date("Y-m-d", strtotime($_POST['inputFechaNacimientoNino']));
				$nombreCompletoNino = $_POST['inputNombreNino'].' '.$_POST['inputApellidosNino'];
				$insertHijo="INSERT INTO `ninos`(`id`, `nombre`, `fecha_nac`, `sexo`, `talla`, `fkIdCurso`, `observaciones`, `fkIdPadre`) 
				VALUES (".$iIdUltimoRegistroNino.",'".$nombreCompletoNino."','".$fechaNacimientoNino."','".$_POST['radioSexoNino']."','".$_POST['inputSelectTallaNino']."',".$_POST['inputSelectCursoNino'].",'".$observaciones."',".$iIdPadre.");";
				$mysqli->query($insertHijo);
				$iIdNino=$mysqli->insert_id;
					if($iIdNino){
						$checkComedor = isset($_POST["checkComedor"]) ? 1 : 0;
						$checkMadrugador = isset($_POST["checkMadrugador"]) ? 1 : 0;
						$precioTotal = $aPrecio['precio'];
						if($checkComedor){
							$precioTotal += 30;
						}
						if($checkMadrugador){
							$precioTotal += 5;
						}

						$fechaActual = date("Y-m-d");
						$insertInscripcion="INSERT INTO `inscripcion`(`id`, `fecha`, `fkIdNino`, `fkIdActividad`, `fkIdSemana`, `comedor`, `madrugador`, `precioTotal`) 
						VALUES (".$iIdUltimoRegistroInscripcion.",'".$fechaActual."',".$iIdNino.",".$aPlazas['fkIdActividad'].",".$aPlazas['fkIdSemana'].",".$checkComedor.",".$checkMadrugador.",".$precioTotal.");";
						$mysqli->query($insertInscripcion);
						if($mysqli->query($insertInscripcion)){
							// Modificar el número de plazas disponibles para la posibilidad de inscribir niños
							$sModificarPlazas = "UPDATE plazas SET plazasOcupadas = plazasOcupadas+1 where id = ".$_POST["selectActividades"]."";
							$mysqli->query($sModificarPlazas);
							if($mysqli->query($sModificarPlazas)){
								echo '<p>Inscripción realizada con exito.</p>';
							}
							else{
								// rollback error update plazas
								//$mysqli->rollBack();
							}
						}
						else{
							// rollback error insert inscripcion
							//$mysqli->rollBack();
						}
					}
					else{
						// rollback error insert niño
						//$mysqli->rollBack();
					}
				}
				else{
					// rollback error insert padre
					//$mysqli->rollBack();
				}
				
		}
		else{
			echo '<p>No hay plazas disponibles para la actividad y semana elegidas.
			 Por favor vuelva a la pantalla de colonias y seleccione otra actividad o semana.</p>';
		}

	}
	echo '<a href="colonias.php"><p>Volver a colonias.</p></a>';

	$mysqli->close();

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/footer.php"); 
}else{
	// Sesion no iniciada
	header("location: /loginbd/ejercicio27.php");
}
?>