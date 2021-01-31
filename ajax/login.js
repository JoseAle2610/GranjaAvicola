$('#formRestaurarClave').hide();
$(document).ready(function(){

	let respuesta = '';

	$('#restaurarClave').click(function(){
		$('#formLogin').hide();
		$('.esconder').hide();
		$('#formRestaurarClave').show();
	});
	$('#cancelar').click(function(){
		$('#formLogin').show();
		$('.esconder').show();
		$('#formRestaurarClave').hide();
	});
	// $('#buscarPregunta').click(function (){
	// 	let nombreUsuario = $('#nombreUsuario').val();
	// 	$.ajax({
 //            url:  "?c=ajax1&m=recuperarClave",
 //            data: 'nombreUsuario='+nombreUsuario,
 //            type: 'GET',
 //            success: function(respuesta){
 //                if (!respuesta.error) {
 //                    let datos = JSON.parse(respuesta);
 //                    console.log(datos);
 //                    if (datos.nombreUsuario == nombreUsuario) {
 //                    	$('#pregunta').html(datos.pregunta);
 //                    	respuesta = datos.pregunta;
 //                    }else{
 //                    	alert('Este usuario no existe');
 //                    }
 //                }
 //            }
	// 	});
	// });

	$('#formRestaurarClave').submit(e => {
		e.preventDefault();
		alert('Esta opcion no esta disponible todavia');

		// let nombreUsuario = $('#nombreUsuario').val();
		// let resuesta = $('#respuesta').val();
		// let clave = $('#nuevaClave').val()
		// let claveConfirmar = $('#nuevaClaveConfirm').val()
		// if (clave != claveConfirmar) {
		// }
	});
	$('#Buscar').click(function(){
		 if ($('#nombreUsuarioRecuperar').val() == null || $('#nombreUsuarioRecuperar').val().length == 0 || /^\s*$/.test($('#nombreUsuarioRecuperar').val())){
		 	alert('Ingrese Nombre de Usuario a buscar');
		 } else{
			let nombreUsuario = $('#nombreUsuarioRecuperar').val();
			 $.ajax({
	            url: '?c=Ajax1&m=recuperarClave',
	            data: 'nombreUsuario='+nombreUsuario,
	            type: 'GET',
	            success: function (respuesta) {
	            	if (!respuesta.error) {
	            		console.log(respuesta);
		                if(respuesta != "[]") { 
		                	let datos = JSON.parse(respuesta);
		                	$('#PreguntaSeguridad').html(datos[0].pregunta);
		                	$('#nombreUsuarioRecuperar').prop('readonly', true);
		                }else{
		                	alert('El usuario que buscas no existe');
		                }
	            	} else alert('Ha ocurrido un Error, intente nuevamente');
	            } 
	        });
		}
	})
	$('#formularioCambiarContra').submit(e => {
	    if ($('#nombreUsuarioRecuperar').val() == null || $('#nombreUsuarioRecuperar').val().length == 0 || /^\s*$/.test($('#nombreUsuarioRecuperar').val())) {
        	e.preventDefault();
        	alert('Ingrese Nombre de Usuario a buscar');
        }else if ($('#RespuestaPreguntaSeguridad').val() == null || $('#RespuestaPreguntaSeguridad').val().length == 0 || /^\s*$/.test($('#RespuestaPreguntaSeguridad').val())) {
            e.preventDefault();
            alert('Ingrese la respuesta del usuario '+$('#nombreUsuarioRecuperar').val());
        } else if ($('#ContraseñaNueva').val() == null || $('#ContraseñaNueva').val().length == 0 || /^\s*$/.test($('#ContraseñaNueva').val())) {
        	e.preventDefault();
        	alert('Ingrese la nueva contraseña del usuario '+$('#nombreUsuarioRecuperar').val());
        } else if ($('#RepeticiónContraseña').val() == null || $('#RepeticiónContraseña').val().length == 0 || /^\s*$/.test($('#RepeticiónContraseña').val())) {
        	e.preventDefault();
        	alert('Repita la contraseña por razones de seguridad');
        } else{
			let nombreUsuario = $('#nombreUsuarioRecuperar').val();
			 // $.ajax({
	   //          url: '?c=Ajax1&m=recuperarClave',
	   //          data: 'nombreUsuario='+nombreUsuario,
	   //          type: 'GET',
	   //          success: function (respuesta) {
	   //          	if (!respuesta.error) {
		  //               	let datos = JSON.parse(respuesta);
	   //          		// console.log(datos[0].respuesta);
	   //          		// console.log($('#RespuestaPreguntaSeguridad').val());
		  //               	if (datos[0].respuesta != $('#RespuestaPreguntaSeguridad').val()) {
		  //               		e.preventDefault();
		  //               		alert('La respuesta dada a su Pregunta de Seguridad no es la misma');
		  //               	}else{
		  //               		if ($('#ContraseñaNueva').val() != $('#RepeticiónContraseña').val()) {
		  //               			e.preventDefault();
		  //               		}else{
		  //               			console.log("bien");
		  //               		}
		                		
		  //               		console.log("noup");
		                		
		  //               	}
	   //          	} else alert('Ha ocurrido un Error, intente nuevamente');
	   //          } 
	   //      });
		}
    });

});