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

});