$(document).ready(function() {
	// Cargar localidades en formulario Etopia - inscripcion.php
	$("#selectProvincias").change(function(){
		var valueProv = $( "#selectProvincias" ).val();
		if(valueProv != ""){
			$.post("provincias.php",
				{fkIdProvincia: valueProv},
				function(respuesta){
		 			$("#selectLocalidades").html(respuesta);
				}
			);
		}
	});
	$("#selectProvincias").change();
	// Cargar complemento COMEDOR a valor de amount para Paypal
	$("#inscripcion #checkComedor").click(function(){
		valorAmount = 0;
		valorAmount = parseInt($("#amount").val());
		if($("#inscripcion #checkComedor").prop("checked")){
			valorAmount += 30;
		}
		else{
			valorAmount -= 30;
		}
		$("#amount").val(valorAmount);
	});
	// Cargar complemento MADRUGADOR a valor de amount para Paypal
	$("#checkMadrugador").click(function(){
		valorAmount = 0;
		valorAmount = parseInt($("#amount").val());
		if($("#inscripcion #checkMadrugador").prop("checked")){
			valorAmount += 5;
		}
		else{
			valorAmount -= 5;
		}
		$("#amount").val(valorAmount);
	});
	//$("#checkMadrugador").change();

	// Carga valor a pagar en funcion de los complementos y de la semana
	$("#selectActividades").change(function(){
		var fkIdPlaza = $("#selectActividades").val();
		if(fkIdPlaza != ""){
			$.post(
				"/etopia/proceso-precio.php",
				{idPlaza: fkIdPlaza},
				function(respuesta){
					valorAmount = parseInt(respuesta);
					
					// Si ya habia checked al cambiar de actividad, 
					// añadimos las cantidades correspondientes
					if($("#inscripcion #checkMadrugador").prop("checked")){
						valorAmount += 5;
					}
				 	if($("#inscripcion #checkComedor").prop("checked")){
						valorAmount += 30;
					}
				 	
				 	$("#amount").val(valorAmount);
				 	
				}
			);
		}
		
	});
	//$("#selectActividades").change();

	// Guardamos los datos del post del formulario para poder utilizarlos
	// tras el proceso de pago en Paypal
	$("input, textarea, select").blur(function() {
		//console.log("blur");
      var dataString = $('#inscripcion').serialize();
      //console.log(dataString);
    	$.post(
			"/etopia/proceso-precio.php",
			{data: dataString},
			function(respuesta){
				//console.log(respuesta);
			}
        );

  });


});