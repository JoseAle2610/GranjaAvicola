$(document).ready( function (){
	// agregarRecogida

	$('.infoRecogida').click(function(){
		// limpiarName();
		let idRegistro = $(this).attr('idRegistro');
		let idSector = 0;
        $.ajax({
            url:  "?c=ajax1&m=infoRecogida",
            data: 'idRegistro='+idRegistro,
            type: 'GET',
            success: function(respuesta){
                if (!respuesta.error) {
                    let datos = JSON.parse(respuesta);

                    let inputs = document.getElementsByClassName('limpiar');
                    let obj = datos.valores;
                    for (var w = 0; w < 3; w++) {
						let inputs = document.getElementsByClassName('fila'+w);
						for( let i = 0; i < inputs.length; i++){
							inputs[i].value = '';
							inputs[i].setAttribute('name', `recogida[${w}][${i+1}]`);
						}
			    	}
                    let x = 0;
                    Object.entries(obj).forEach(([recogida, value]) => {
					    Object.entries(value).forEach(([categoria, valor]) => {
					    	let input = document.querySelector('.categoria'+categoria+' .fila'+x);
					    	input.setAttribute("name", `editarRecogida[${recogida}][${categoria}]`);
					    	input.value = valor;
						});
						x++;
					});
                    $('#idGalpon').val(datos.idGalpon);
                    refrescarSelect(datos.idGalpon);
                    idSector = datos.idSector;
                    $('#fecha').val(datos.fecha);
                    $('#responsable').val(datos.ci);
                    $('#editarRecogida').val(1);
                }
            }
		});
        $('#idSector').val(idSector);
	});

    $('.agregarRecogida').click(function(){
    	$('#idGalpon').val('0');
    	$('#fecha').val('2020-10-23');
    	for (var x = 0; x < 3; x++) {
			let inputs = document.getElementsByClassName('fila'+x);
			for( let i = 0; i < inputs.length; i++){
				inputs[i].value = '';
				inputs[i].setAttribute('name', `recogida[${x}][${i+1}]`);
			}
    	}
    	$('#idSector').html('');
    	$('#editarRecogida').val(0);
    });
});

function refrescarSelect(idGalpon){
	$.ajax({
    url: '?c=Ajax&m=sectorAnidado',
    data: 'idGalpon='+idGalpon,
    type: 'GET',
    success: function (respuesta) {
      if(!respuesta.error) {
        let datos = JSON.parse(respuesta);
        let html = '';
        datos.forEach(dato => {
          html += `<option value='${dato.id}'> ${dato.nombre}`;
        });
        $('.idSector').html(html);
        console.log(datos, html);
      }
    } 
  })
}
// function limpiarName(){
// 	for(let x = 0; x < 3; x++){
// 		let inputs = document.getElementsByClassName('fila'+x);
// 		for( let i = 1; i <= inputs.length ; i++){
// 			inputs[i].setAttribute('name', `recogida[${x}][${i}]`);
// 			inputs[i].value = '';
// 		}
// 	}
// }