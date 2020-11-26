


$(document).ready(function (){
	
  // numeroModulo
  // agregarGalpon
  $('#agregarGalpon').click(function (){
    var numeroModulo = $('#numeroModulo').val();
    var elementoTabla = $('#tablaModulos tbody').html();
        elementoTabla += `<tr>
                            <td>M-${numeroModulo}</td>
                            <td class="btn-group justify-content-center d-flex">
                              <button type="button" class="btn btn-danger form-control" data-toggle="modal" data-target="#Alerta">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                              <input type="hidden" name="modulos[]" value="${numeroModulo}">
                            </td>
                      </tr>`;
    
    $('#tablaModulos tbody').html(elementoTabla);
    console.log('hola ', numeroModulo);
  });








	// $('.idGalpon').val(4);

	// $('.idGalpon').change(function(){
	// 	let idGalpon = $('.idGalpon').val();
	// 	console.log(idGalpon);
	// 	$.ajax({
 //        url: '?c=Ajax&m=sectorAnidado',
 //        data: 'idGalpon='+idGalpon,
 //        type: 'GET',
 //        success: function (respuesta) {
 //          if(!respuesta.error) {
 //            let datos = JSON.parse(respuesta);
 //            let html = '';
 //            datos.forEach(dato => {
 //              html += `<option value='${dato.id}'> ${dato.nombre}`;
 //            });
 //            $('.idSector').html(html);
 //            console.log(datos, html);
 //          }
 //        } 
 //      })
	// })
})