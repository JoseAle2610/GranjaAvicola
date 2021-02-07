$(document).ready( function (){
	// agregarRecogida

	$('.infoRecogida').click(function(){
		limpiarformularioRecogida();
        $('#AgregarReco').html('Editar Recogida');
		let idRegistro = $(this).attr('idRegistro');

        $.ajax({
            url:  "?c=ajax1&m=infoRecogida",
            data: 'idRegistro='+idRegistro,
            type: 'GET',
            success: function(respuesta){
                if (!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    // LLENAMOS LOS DATOS DE LA TABLA
                    let datosRegistro = datos.valores;
                    let x = 0;
                    Object.entries(datosRegistro).forEach(([recogida, valores]) => {
                        let inputss = document.getElementsByClassName(`fila${x}`);
                        for (var i = 0; i < inputss.length; i++) {
                            inputss[i].setAttribute('name', `recogidaAgregarValor[${recogida}][${i+1}]`);
                            inputss[i].value = '';
                        }
					    Object.entries(valores).forEach(([categoria, valor]) => {
					    	let input = document.querySelector(`.categoria${categoria} .fila${x}`);
					    	input.setAttribute("name", `recogidaEditarValor[${recogida}][${categoria}]`)
                            input.value = valor;
						});
						x++;
					});
                    // LLENAMOS LOS DATOS DEL FORMULARIO
                    $('#idGalpon').val(datos.idGalpon);
                    $('#idGalpon').prop('disabled', true);
                    $('#idSector').attr('readonly', true);
                    refrescarSelect(datos.idGalpon, datos.idSector);
                    $('#fecha').val(datos.fecha);
                    if (datos.responsableActivo == 0) {
                        let responsableOptions = $('#responsable').html();
                            responsableOptions += `<option value="${datos.ci}" class='responsableInactivo'>
                                                        ${datos.ci} (Inactivo)
                                                    </option>`;
                            $('#responsable').html(responsableOptions);
                    }
                    $('#responsable').val(datos.ci);
                    $('#editRecogida').val(1)
                    // PASAMOS TAMBIEN EL ID DE REGISTRO QUE ACABAMOS DE LLENAR POR SI ACASO
                    $('#idRegistro').val(idRegistro);

                }
            }
		});
	});

    $('.idGalpon').change(function(){
        let idGalpon = $('.idGalpon').val();
        console.log(idGalpon);
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
        });
    });

    $('.agregarRecogida').click(function(){
    	limpiarformularioRecogida();
        $('#AgregarReco').html('Agregar Recogida');
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy+'-'+mm+'-'+dd;
    	$('#fecha').val(today);
        // inutilizamos el input hidden para solventar el problema del select desavilitado
        // $('#idSectorActualizar').removeAttr('name', 'idSector');
        // $('#idSectorActualizar').val('');
    });

function limpiarformularioRecogida(){
	$('#idGalpon').val('0');
	$('#idSector').html('');
	$('#editRecogida').val(0);
    $('#idGalpon').prop('disabled', false);
    $('#idSector').attr('readonly', false);
    $('.responsableInactivo').remove();
    for (var x = 0; x < 3; x++) {
        let inputs = document.getElementsByClassName('fila'+x);
        for( let i = 0; i < inputs.length; i++){
            inputs[i].value = '';
            inputs[i].setAttribute('name', `recogidaValor[${x}][${i+1}]`);
        }
    }
}

});
////////////////////////
// FUNCIONES DE AYUDA //
////////////////////////
function refrescarSelect(idGalpon, idSector){
	$.ajax({
    url: '?c=Ajax&m=sectorAnidado&activo=0',
    data: 'idGalpon='+idGalpon,
    type: 'GET',
    success: function (respuesta) {
        if(!respuesta.error) {
            let datos = JSON.parse(respuesta);
            let html = '';
            datos.forEach(dato => {
                let selected = (dato.id == idSector) ? 'selected' : '';
                html += `<option value='${dato.id}' ${selected}> ${dato.nombre}`;
            });
            $('.idSector').html(html);
        }
    } 
  })
}
// function limpiarformularioRecogida(){
// 	for(let x = 0; x < 3; x++){
// 		let inputs = document.getElementsByClassName('fila'+x);
// 		for( let i = 1; i <= inputs.length ; i++){
// 			inputs[i].setAttribute('name', `recogida[${x}][${i}]`);
// 			inputs[i].value = '';
// 		}
// 	}
// }