<?php
session_start();
if(isset($_SESSION["usuarioValido"]) && $_SESSION["usuarioValido"]){
	// Mostramos la informacion de una actividad en particular
	// obtenemos el id desde la url con el parametro ID
	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/header.php"); 
	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/conexion.inc.php"); 

	// SQL
	$iIdActividad = $_GET['id'];
	$sConsultaActividad = "SELECT * FROM actividades AS act
		INNER JOIN plazas AS pla ON act.id = pla.fkIdActividad 
		WHERE act.id = $iIdActividad";
	$aResultadoActividad = $mysqli->query($sConsultaActividad)->fetch_assoc();

	$sConsultaProfesores = "SELECT pf.id, nombre, url FROM actividadesprofesores as ap
		INNER JOIN profesores AS pf ON pf.id = ap.fkIdProfesor 
		WHERE ap.fkIdActividad = $iIdActividad";
	$aResultadoProfesor = array();
	$row = $mysqli->query($sConsultaProfesores);
	while($profesor = $row ->fetch_assoc()){
		$aResultadoProfesor[] = $profesor;
	}

	$sConsultaSemanaInscripcionDisponible = "SELECT act.id as idActividad, titulo, descripcionCorta,
	descripcionLarga, foto, edadMin, edadMax, pla.id as idPlaza, fkIdActividad, fkIdSemana,
	numPlazas, plazasOcupadas, sem.id  as idSemana, nombre, fechaInicio, fechaFin, precio 
		FROM actividades as act
		INNER JOIN plazas as pla ON pla.fkIdActividad = act.id
		INNER JOIN semanas as sem ON sem.id = pla.fkIdSemana
		WHERE numPlazas > 0 AND plazasOcupadas < numPlazas 
		AND fechaInicio > curdate()
		AND act.id = $iIdActividad
		ORDER BY act.id ASC, sem.id ASC";
	$aResultadoSIDisponible = array();
	$fila = $mysqli->query($sConsultaSemanaInscripcionDisponible);
	while($info = $fila ->fetch_assoc()){
		$aResultadoSIDisponible[] = $info;
	}

	$sContenido = "";
	if(!empty($aResultadoActividad)){

			$sContenido .= '<div class="row">';
				$sContenido .= '<div class="col-md-12">';
				// titulo actividad - pasamos el id de la actividad por parámetro
					$sContenido .= '<h2>'.$aResultadoActividad["titulo"].'</h2>';

					// imagen actividad
					$sContenido .= '<img src="/'.$aResultadoActividad["foto"].'" title="'.$aResultadoActividad["titulo"].'"
					alt="'.$aResultadoActividad["titulo"].'" class="img-responsive">';
				
					///////////////////////////////////////////////////////////////
					////////////////////COLUMNA IZQUIERDA col-9////////////////////
					///////////////////////////////////////////////////////////////
					$sContenido .= '<div class="row">';
						$sContenido .= '<div class="col-md-8" id="contenidoTexto">';

							// desc larga
							$sContenido .= '<p>'.$aResultadoActividad["descripcionLarga"].'</p><br>';

							// edad min  -  edad max
							$sContenido .= '<p>Edad: niños y niñas entre '.$aResultadoActividad["edadMin"].' y '.$aResultadoActividad["edadMax"].' años.</p><br>';

							// Profesores
							$sProfesores ="";
							$iCont = 1;
							foreach ($aResultadoProfesor as $key => $profesores) {

								if(!empty($profesores["url"])){
									$sProfesores .= '<a class="enlace" href="'.$profesores["url"].'">'.$profesores["nombre"].'</a>';
								}
								else{
									$sProfesores .= $profesores["nombre"];	
								}
								// Modificar ',' por ' y ' y '.'
								if($iCont < sizeof($aResultadoProfesor)-1){
									$sProfesores .= ', ';
								}
								if($iCont == sizeof($aResultadoProfesor) -1){
									$sProfesores .= ' y ';
								}
								$iCont++;
							}
							
							$sContenido .= '<p>Imparte: '.$sProfesores.'.</p><br>';

						$sContenido .= '</div>';
							///////////////////////////////////////////////////////////////
							//////////////////// COLUMNA DERECHA col-3 ////////////////////
							///////////////////////////////////////////////////////////////

						$sContenido .= '<div id="inscripcionGrid" class="col-md-4">';
						$sContenido .= '<h2>Inscripciones</h2>';
							foreach ($aResultadoSIDisponible as $array => $row) {
								if($row["plazasOcupadas"] < $row["numPlazas"]){
									$sContenido .= '<div class="cell" style="text-align: center;">';
										//$sContenido .= '<form id="formularioInscripcion">';
										$sContenido .= '<form id="formularioInscripcion" method="post" action="/etopia/inscripcion.php">';

											//inputs hidden para inscripcion
											$sContenido .= '<input type="hidden" id="fkIdActividadPost" name="fkIdActividadPost" value="'.$row["fkIdActividad"].'" />';
											$sContenido .= '<input type="hidden" id="fkIdSemanaPost" name="fkIdSemanaPost" value="'.$row["fkIdSemana"].'" />';

											// datos de cada semana
											$sContenido .= '<p><strong>'.$row["titulo"].'</strong></p>';
											$sContenido .= 'De '.$row["fechaInicio"].' a '.$row["fechaFin"].'<br>';
											$sContenido .= '<strong>'.$row["precio"].' &euro;</strong>
															</p>';

											$sContenido .= '<button class="btn btn-primary" type="submit">Inscribir</button>';
											/*$sContenido .= '<p align="center"><a class="btn btn-danger boton" href="inscripcion.php?idplaza='.$row["idPlaza"].'">';
											$sContenido .= '<span>Inscríbete</span>';
											$sContenido .= '</a></p>';*/
											
										$sContenido .= '</form>';
									$sContenido .= '</div>';
								}
							}
						$sContenido .= '</div>';

					$sContenido .= '</div>';
				$sContenido .= '</div>';
			$sContenido .= '</div>';

	}
	else{
		// No hay actividad
		$sContenido .= '<div>
							<p class="alert alert-warning">No hay información relacionada sobre la actividad</p>
						</div>';
	}


	$sContenido .= '<div>
						<a class="enlace" href="/etopia/colonias.php">Volver a las actividades</a>
					</div>';

	echo $sContenido;

	// FIN SQL
	$mysqli->close();

	include($_SERVER['DOCUMENT_ROOT']."/etopia/inc/footer.php"); 
}
else{
	// Sesion no iniciada
	header("location: /loginbd/ejercicio27.php");
}
?>