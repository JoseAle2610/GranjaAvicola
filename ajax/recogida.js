$(document).ready( function (){
	// agregarRecogida

	$('.infoRecogida').click(function(){
		limpiarName();
		let idRegistro = $(this).attr('idRegistro');
		let idSector = 0;
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
					    	let input = document.querySelector('.categoria'+categoria+' .fila'+x);
					    	input.setAttribute("name", `recogidaEditarValor[${recogida}][${categoria}]`);
					    	input.value = valor;
						});
						x++;
					});
                    // LLENAMOS LOS DATOS DEL FORMULARIO
                    $('#idGalpon').val(datos.idGalpon);
                    $('#idGalpon').prop('disabled', true);
                    $('#fecha').val(datos.fecha);
                    $('#responsable').val(datos.ci);
                    refrescarSelect(datos.idGalpon, datos.idSector);
                    // COMO AL DESAVILITAR EL SELECT ID SECTOR NO SE ENVIAN LOS DATOS AL SERVIDOR
                    // HAY QUE AGREGAR UN INPUT HIDDEN CON EL MISMO NAME Y VALOR
                    $('#idSector').prop('disabled', true);
                    $('#idSectorActualizar').val(datos.idSector);
                    $('#idSectorActualizar').attr('name', 'idSector');
                    // LLENAMOS ESTE INPUT HIDDEN QUE LE DIRA AL SERVIDOR SI ESTAMOS EDITANDO O NO
                    $('#editRecogida').val(1);
                    // PASAMOS TAMBIEN EL ID DE REGISTRO QUE ACABAMOS DE LLENAR POR SI ACASO
                    $('#idRegistro').val(idRegistro);
                }
            }
		});
	});

    $('.agregarRecogida').click(function(){
    	$('#idGalpon').val('0');
    	$('#fecha').val('2020-10-23');
    	limpiarName();
    	$('#idSector').html('');
    	$('#editRecogida').val(0);
        $('#idGalpon').prop('disabled', false);
        $('#idSector').prop('disabled', false);
        // inutilizamos el input hidden para solventar el problema del select desavilitado
        $('#idSectorActualizar').removeAttr('name', 'idSector');
        $('#idSectorActualizar').val('');
    });

function limpiarName(){
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
    url: '?c=Ajax&m=sectorAnidado',
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