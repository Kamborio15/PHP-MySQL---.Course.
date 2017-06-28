
$(document).ready(function(){
	// Datepicker
	$( function() {
		//$( "#inputFechaNacimientoNino" ).datepicker();
		//$( "#inputFechaNacimientoPadre" ).datepicker();
		$( "input[name^='inputFechaNacimiento']" ).datepicker();
		
		//$( "input[name^='inputFechaNacimiento']" ).datepicker.setDefaults($.datepicker.regional["es"]);
	      $( "input[name^='inputFechaNacimiento']" ).datepicker( "option", "dateFormat", "mm/dd/yy" );
	} );

	/*$("#selectActividades").change(function(){
		var valorSelector = $("#selectActividades").val();

	});

	$("#selectActividades").change();*/


});


