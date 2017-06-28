<?php
session_start();
if(isset($_SESSION["usuarioValido"]) && $_SESSION["usuarioValido"]){
	// Pagina para rellenar el formulario de inscripción para una actividad en una semana determinada
	// Llegamos desde la página de actividad.php


	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/header.php"); 
	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/conexion.inc.php"); 
	include($_SERVER['DOCUMENT_ROOT']."/Utils/Utils.php"); 
	$oUtils = new Utils();
	//DEBUG
	/*$iIdActividad = 1;
	$iIdSemana = 1;*/
	// FIN DEBUG


	// SQL
	// Recuperamos la info para una actividad y semana determinada
	$sConsulta = "SELECT titulo, pla.id as fkIdPlaza, numPlazas, plazasOcupadas, 
					sem.id as fkIdSemana, sem.nombre, fechaInicio, fechaFin, precio, act.id as fkIdActividad FROM actividades as act
					INNER JOIN plazas as pla ON pla.fkIdActividad = act.id
					INNER JOIN semanas as sem ON sem.id = pla.fkIdSemana
					WHERE numPlazas > 0 AND plazasOcupadas < numPlazas AND fechaInicio > curdate()
					ORDER BY act.id ASC, sem.id ASC";
	$aInfoActividadSemana = array();
	$fila = $mysqli->query($sConsulta);
	while($row = $fila->fetch_assoc()){
		$aInfoActividadSemana[] = $row;
	}

	// Consulta cursos de niños
	$sConsultaCursos = "SELECT * FROM curso";
	$aInfoCursos = array();
	$row1 = $mysqli->query($sConsultaCursos);

	while($row2 = $row1->fetch_assoc()){
		$aInfoCursos[] = $row2;
	}

	$sSelectorCursos = "";
	if(isset($_POST) && !empty($_POST)){

	// Consultas para la info de la inscripción
	$fkIdActividad = $_POST["fkIdActividadPost"];
	$sConsultaActividad = "SELECT titulo FROM actividades WHERE id = $fkIdActividad";
	$row3 = $mysqli->query($sConsultaActividad);
	$aTituloActividad = $row3->fetch_assoc();


	$fkIdSemana = $_POST["fkIdSemanaPost"];
	$sConsultaSemana = "SELECT * FROM semanas WHERE id = $fkIdSemana";
	$row4 = $mysqli->query($sConsultaSemana);
	$aInfoSemana = $row4->fetch_assoc();

	// Selector provincias (datos padre)
	$sProvincias = "select * from provincia";
	$resultadoProv = $mysqli->query($sProvincias);

	$precioHidden = 0;
	?>

	<form id="inscripcion" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" style="border: 1px solid lightgrey; padding-left:30px; padding-bottom:10px;">
			<!-- SELECTOR DE ACTIVIDAD -->
			<div id="selector">
				<h2>Selector de inscripción</h2>
				<?php $sSelect = ""; 
				//$test = ""; ?>
				<select id="selectActividades" name="selectActividades">
					<?php 
						foreach ($aInfoActividadSemana as $row => $data) {
							$sSelect .= '<option';
							// Preseleccionar una opcion si vienen desde la pantalla de la actividad 
							//y seleccionan el botón de inscribir en una semana determinada
							if(isset($_POST['fkIdActividadPost']) && isset($_POST['fkIdSemanaPost'])){

								//$test .= "<pre>$_POST[fkIdActividadPost] - $data[fkIdActividad] -- $_POST[fkIdSemanaPost] - $data[fkIdSemana]</pre>";

								if($_POST['fkIdActividadPost'] == $data['fkIdActividad'] && $_POST['fkIdSemanaPost'] == $data['fkIdSemana']){
									//$test .= "if if";
									$sSelect .= ' selected ';
									$precioHidden = (int)$data["precio"]; // precio hidden para Paypal
								}
							}
							$sSelect .= ' value="'.$data["fkIdPlaza"].'">"'.$data["titulo"].'", 
								'.$data["titulo"].' de '.$oUtils->convertDate($data["fechaInicio"]).' al 
								'.$oUtils->convertDate($data["fechaFin"]).' - '.$data["precio"].' &euro;
								</option>';
						}
					echo $sSelect; ?>
				</select>
				<p>**Si desea cambiar de actividad o semana, acuda a la página de la actividad y selecccione [Inscribir] allí</p>
			</div>

			<!-- INPUTS HIDDEN PARA CONTROL DATOS EN PAYPAL -->

            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="tienda.pruebas-1@paypal.com">
            <input type="hidden" name="item_name" value="inscripcion">
            <input type="hidden" name="currency_code" value="EUR">
            <input type="hidden" name="amount" id="amount" value="<?php echo $precioHidden; ?>">
           	<input type="hidden" name="return" value="http://miweb.com/paypal/pago-ok.php">
			<input type="hidden" name="cancel_return" value="http://miweb.com/paypal/cancelar-compra.html">
			<!-- FIN INPUTS HIDDEN -->




			<!--<input type="hidden" id="inputSelectActividades" name="inputSelectActividades" value="">-->

			<!-- clear:both -->
			<div style="clear:both"></div>

			<!-- COMPLEMENTOS ADICIONALES -->
			<div id="complementosadicionales">
				<h2>Complementos adicionales</h2>

				<div id="complementoComedor" class="checkbox d-block">
					<label class="checkbox-inline" for="checkComedor">
						<input id="checkComedor" name="checkComedor" value="1" type="checkbox">
						Servicio de comedor (Salida a 15h). - 30 €
					</label>
				</div>
				<div id="complementoMadrugador" class="checkbox d-block">
					<label class="checkbox-inline" for="checkMadrugador">
						<input id="checkMadrugador" name="checkMadrugador" value="1" type="checkbox">
						Servicio de madrugadores (de 8h a 9h). - 5 €
					</label>
				</div>
			</div>

			<!-- clear:both -->
			<div style="clear:both"></div>

			<!-- DATOS DEL NIÑO -->
			<div id="datosNino">
				<h2>Datos del niño</h2>
				<div id="nombreNino">
					<label>* Nombre
						<input type="text" name="inputNombreNino" id="inputNombreNino" required>
					</label>
				</div>
				<div id="apellidosNino">
					<label>* Apellidos
						<input type="text" name="inputApellidosNino" id="inputApellidosNino" required>
					</label>
				</div>
				<div id="fechaNacimientoNino">
					<label>* Fecha de nacimiento
						<input type="text" name="inputFechaNacimientoNino" id="inputFechaNacimientoNino" required>
						<span class="glyphicon glyphicon-calendar"></span>
					</label>
				</div>
				<div id="sexoNino">
					<span>* Se trata de un </span>
					<label><input type="radio" id="radioSexoNinoM" name="radioSexoNino" value="M" checked>Niño
					</label>
					<label><input type="radio" id="radioSexoNinoH" name="radioSexoNino" value="H">Niña
					</label>
				</div>
				<div id="tallaNino">
					<label>* Talla
						<input type="text" name="inputSelectTallaNino" id="inputSelectTallaNino" placeholder="S, M, L, XL" required>
					</label>
				</div>
				<div id="cursoEscolarNino">
					<label>* Curso
						<select name="inputSelectCursoNino" id="inputSelectCursoNino" required>
							<?php $sSelectorCursos .= '<option value="">Seleccione un curso</option>';
							foreach ($aInfoCursos as $indice => $curso) {
								$sSelectorCursos .= '<option value="'.$curso["id"].'">'.$curso["nombre"].'</option>';
							}
							echo $sSelectorCursos;
							?>
						</select>
					</label>
				</div>
				<div id="observacionesNino">
					<label for="inputObservacionesNino">Observaciones
						<textarea rows="4" cols="50" id="inputObservacionesNino" name="inputObservacionesNino"></textarea>
					</label>
				</div>
			</div>

			<!-- clear:both -->
			<div style="clear:both"></div>
			
			<div id="datosPadre">
				<h2>Datos del padre</h2>
				<div id="nombrePadre">
					<label>* Correo electrónico
						<input type="email" name="inputEmailPadre" id="inputEmailPadre" required>
					</label>
				</div>
				<div id="nombrePadre">
					<label>* Nombre
						<input type="text" name="inputNombrePadre" id="inputNombrePadre" required>
					</label>
				</div>
				<div id="apellidosPadre">
					<label>* Apellidos
						<input type="text" name="inputApellidosPadre" id="inputApellidosPadre" required>
					</label>
				</div>
				<div id="nifPadre">
					<label>* NIF
						<input type="text" name="inputNIFPadre" id="inputNIFPadre">
					</label>
				</div>
				<div id="telefonoPadre">
					<label>* Teléfono
						<input type="text" name="inputTelefonoPadre" id="inputTelefonoPadre">
						<span>Será utilizado en caso de emergencia</span>
					</label>
				</div>
				<div id="fechaNacimientoPadre">
					<label>* Fecha de nacimiento
						<input type="text" name="inputFechaNacimientoPadre" id="inputFechaNacimientoPadre" required>
						<span class="glyphicon glyphicon-calendar"></span>
					</label>
				</div>
				<div id="direccionPadre">
					<label>* Dirección
						<input type="text" name="inputDireccionPadre" id="inputDireccionPadre">
					</label>
				</div>
				<div id="codigoPostalPadre">
					<label>* Código Postal
						<input type="text" name="inputCodigoPostalPadre" id="inputCodigoPostalPadre">
					</label>
				</div>
				<div id="provinciaPadre">
					<label for="selectProvincias">Provincia</label>
					<select name="selectProvincias" id="selectProvincias">
						<option value="">Seleccione una provincia</option>
						<?php foreach ($resultadoProv as $provincia) {// Cargar datos en selector provincias?>
							<option value="<?php echo $provincia['id'];?>"><?php echo $provincia['provincia'];?></option>
						<?php }?>
					</select>
				</div>
				<div id="poblacionPadre">
					<label for="selectLocalidades">Localidad</label>
					<select name="selectLocalidades" id="selectLocalidades">
						<option value="" selected>Seleccione una localidad</option>
					</select>
				</div>
			</div>
			
			<!-- clear:both -->
			<div style="clear:both"></div>

			<!-- DATOS SELECCIONADOS -->
			<div id="datosSeleccionados">
				<h2>Has seleccionado para la inscripción</h2>
				<p><b>Actividad: </b><?php echo $aTituloActividad["titulo"]; ?>.</p>
				<p><b>Semana: </b>De <?php echo $oUtils->convertDate($aInfoSemana["fechaInicio"]); ?> a <?php echo $oUtils->convertDate($aInfoSemana["fechaFin"]); ?>.</p>
				<p><b>Opción: </b><?php echo $aTituloActividad["titulo"]; ?>.</p>
			</div>

			<!-- BOTON SUBMIT TOTAL --> 
			<div class="text-center">
				<button type="submit" id="botonSubmit" name="botonSubmit" class="btn btn-success">
					Realizar solicitud
				</button>
			</div>

	</form>
	<?php }
	else{?>
		<p class="alert alert-warning">Primero debe seleccionar en qué semana quiere realizar la inscripcion.</p>
	<?php }


	// FIN SQL
	$mysqli->close();

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/footer.php"); 
}else{
	// Sesion no iniciada
	header("location: /loginbd/ejercicio27.php");
}
?>