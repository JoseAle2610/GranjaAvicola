$(document).ready(function (){
    let loteDatosHide= false;
    $('#loteNuevoDatos').hide();
	
    $('#agregarGalpon').click(function (){

        let numeroModulo = $('#numeroModulo').val();
        let datosModulo = document.getElementsByClassName('puntero');
        let repetido = false;
        // ASEGURARSE DE QUE NO SE REPITA 
        // EL NOMBRE DEL MODULO
        if (datosModulo.length != 0) {
          let arreglo = [];
          for (let i = 0; i < datosModulo.length; i++) {
            if (datosModulo[i].value == numeroModulo) {
              repetido = true;
            }
          }
        }
        // SI NO ESTA VACIO NI ESTA REPETIDO LO AGREGAMOS
        if (numeroModulo != '' && repetido == false) {
            let elementoTabla = $('#tablaModulos tbody').html();
                elementoTabla += elemetoTablaModulo(numeroModulo);
            $('#tablaModulos tbody').html(elementoTabla);
        } else {
          alert('El número del modulo no puede estar vacío ni repetido');
        }
    });

    $(document).on('click', '.eliminarModuloTabla', (e) => {
        $(this)[0].activeElement.parentElement.parentElement.remove();
    });

  // VALIDAMOS QUE EXISTA POR LO MENOS UN MODULO
    $('#formularioAgregarGalpon').submit(e => {

        let datosModulo = document.getElementsByClassName('puntero');
        if (datosModulo.length == 0) {
          e.preventDefault();
          alert('Debe existir por lo menos un modulo');
        }

    });

  // OBTENEMOS TODOS LOS DATOS PARA PODER EDITAR GRACIAS NELLA
    $(".editarGalpon").click(function(){
        let idGalpon = $(this).attr("idGalpon");
        console.log(idGalpon);
        $.ajax({
            url:  "?c=ajax&m=infoGalpon",
            data: 'idGalpon='+idGalpon,
            type: 'GET',
            success: function(respuesta){
            if (!respuesta.error) {
                let datos = JSON.parse(respuesta);
                console.log(datos);
                $('#editarNumeroGalpon').val(datos[0]['nombreGalpon']);
                $('#editarInicioLote').val(datos[0]['inicio']);
                $('#editarNumeroGallinas').val(datos[0]['gallinas']);
                $('#loteActual').html(datos[0]['numeroLote'])
                $('#activo').prop('checked', datos[0]['activo']);

                $('#editarTablaModulos tbody').html('');
                datos.forEach(dato => {
                    let elementoTabla = $('#editarTablaModulos tbody').html();
                    elementoTabla += elemetoTablaModulo(dato.nombreSector, dato.idSector, true)
                    $('#editarTablaModulos tbody').html(elementoTabla);
                    $('#'+dato.idSector).prop('checked', dato.sectorActivo);
                });
            }
        }
    });

})




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

function elemetoTablaModulo (numeroModulo, idModulo = '', editar = false) {
    let button =    `<button type="button" class="btn btn-danger form-control eliminarModuloTabla" >
                        <i class="fas fa-trash-alt"></i>
                    </button>`;
    if (idModulo.length == 0) {
        idModulo = numeroModulo;
    }
    if (editar == true) {
        button = `  <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="${idModulo}" name="activo">
                        <label class="custom-control-label" for="${idModulo}">Activo</label>
                    </div>`;
    }
    let elemento = `<tr class=' p-0 '>
                        <td>M-${numeroModulo}</td>
                        <td class="justify-content-center d-flex">
                            ${button}
                          <input type="hidden" name="modulos[]" value="${idModulo}" class="puntero">
                        </td>
                    </tr>`;
    return elemento;
}