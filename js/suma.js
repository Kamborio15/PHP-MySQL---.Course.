$(document).ready(function(){

	$("button").click(function(e){
		numero1 = $("#inputUno").val();
		numero2 = $("#inputDos").val();

		/*
		// SUBMIT Y MOSTRAR ALERT
		resultado=parseInt(numero1)+parseInt(numero2);
		alert("Numero 1: " + numero1 + "\nNumero 2: " + numero2);
		*/

		// ENVIO DATOS POR POST
		$.post("../ejercicios/ejercicio25-proceso.php",
			 {numero1: numero1, numero2: numero2},
			 function(respuesta){
			 	$("#resultado").html(respuesta);
			 });
		/* /////////////////
		1er parametro: la accion donde se encuentra el proceso
		2o parametro: los datos que recibirá el POST del proceso
		3er parametro: el echo que resulta del proceso, la respuesta
		/////////////// */


		e.preventDefault();
    	});

	//Submit de form
	/*
	$("#formSuma").submit(function(e){
		//alert("hola");
		numero1 = $("#inputUno").val();
		numero2 = $("#inputDos").val();

		resultado=parseInt(numero1)+parseInt(numero2);

		//alert(resultado);
		alert("Numero 1: " + numero1 + "\nNumero 2: " + numero2);
		

		//$("#resultado").html("<p>" + resultado + "</p>");
		e.preventDefault();
    });
	*/

});