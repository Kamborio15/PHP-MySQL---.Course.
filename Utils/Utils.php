<?php class Utils{
	
	// Devuelve boolean si el usuario existe comparando con registros por parámetro
	function bExisteUsuario($usuario, $pass, $registros){
		$bUsuarioValido = false;
		
		// Eliminamos el ultimo campo de cada elemento
		foreach ($registros as $value) {
			$aDatosUsuario = explode(",", $value);
			// los elementos 0 y 1 son el user y el pass
			
			for($i = 0; $i < 2; $i++){ // menor que 2 ya que el user y la pass son la posicion 0 y 1
				$aDatosUsuario[$i] = str_replace("\"","", $aDatosUsuario[$i]);
				$aDatosUsuario[$i] = trim(str_replace(";","", $aDatosUsuario[$i])); // quitamos el ; y el espacio al final
			}

			// Comprobamos la validez del usuario
			if(($aDatosUsuario[0] === $usuario) && ($aDatosUsuario[1] === md5($pass))){
				// Usuario válido
				$bUsuarioValido = true;
				break;
			}
		}

		return $bUsuarioValido;
	}

	// Funcion para debug
	function pre($parametro){
		echo "<pre>";
		print_r($parametro);
		echo "</pre>";
	}


	// Funcion para modificar la visualizacion de las fechas 
	function convertDate($fecha){
		// Formato de entrada "yyyy-MM-dd"
		// Formato de salida "dd-MM-yyyy"

		$fechaAux = explode("-", $fecha);

		$sFecha = $fechaAux[2].'-'.$fechaAux[1].'-'.$fechaAux[0];
		return $sFecha;
	}


} ?>