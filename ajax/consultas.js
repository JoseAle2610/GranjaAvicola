


$(document).ready(function (){
	










	$('.idGalpon').val(4);

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
      })
	})
})