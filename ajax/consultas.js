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
                        if (dato.sectorActivo == 0) {
                        $('#'+dato.idSector).prop('checked', false);
                        }else{
                        $('#'+dato.idSector).prop('checked', true);
                    }
                    });
                }
            }
        });
    });




    $('.editarResponsable').click(function(){
        let ci = $(this).attr("ci");
        console.log(ci);
        $.ajax({
            url:  "?c=ajax&m=infoResponsable",
            data: 'ci='+ci,
            type: 'GET',
            success: function(respuesta){
                if (!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    console.log(datos.activo);
                    $('#NombreResponsable').val(datos.nombreResponsable);
                    $('#ApellidoResponsable').val(datos.apellidoResponsable);
                    if (datos.activo == 0) {
                        $('#activoResponsable').prop('checked', false);
                    }else{
                        $('#activoResponsable').prop('checked', true);
                    }
                    $('#Nacionalidad').val(datos.ci.substring(0,1));
                    $('#Cedula').val(datos.ci.substring(1)); 
                    // $('#Cedula').val(datos.ci);
                    // document.getElementById("activoResponsable").checked = datos.activo;
                    $('#editar').val(true);
                    // $('#Nacionalidad').prop('selected', true);

                }
            }
        });
    })

    $('.eliminarResponsable').click(function(){
        let mensaje = `¿Estas seguro de que quieres eliminar a este Responsable?\n`;
        mensaje += `Recuerda que no se puede restaurar esta accion`;
        if (confirm(mensaje)) {
            let ci = $(this).attr("ci");
            window.location.assign('?c=responsable&m=eliminarResponsable&ci='+ci);
        }
    })

    // ----------------------------------------------
    // EDITANDO USUARIO
    //----------------------------------------------
    $('.editarUsuario').click(function(){
        let idUsuarios = $(this).attr("idUsuarios");
        console.log(idUsuarios);
        $.ajax({
            url:  "?c=ajax&m=infoUsuario",
            data: 'idUsuarios='+idUsuarios,
            type: 'GET',
            success: function(respuesta){
                if (!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    console.log(datos[0].activo);
                    $('#claveUsuarioAgregar').val(datos[0].claveUsuario);
                    $('#nombreUsuarioAgregar').val(datos[0].nombreUsuario);
                    $('#RespuestaUsuarioAgregar').val(datos[0].respuesta);
                    if (datos[0].activo == 0) {
                        $('#activoUsuario').prop('checked', false);
                    }else{
                        $('#activoUsuario').prop('checked', true);
                    }
                    $('#Cedula_Usuario').val(datos[0].ci);
                    $('#preguntaUsuarioAgregar').val(datos[0].pregunta);
                    $('#idUsuarios').val(datos[0].idUsuarios);
                    // $('#Cedula').val(datos.ci);
                    // document.getElementById("activoResponsable").checked = datos.activo;
                    $('#editarUsuario').val(true);
                    // $('#Nacionalidad').prop('selected', true);

                }
            }
        });
    })
    //------------------
    //CONTROL DE AVES 
    //------------------
     $('#Nombre_Galpon').change(function(){
        let Nombre_Galpon = $('#Nombre_Galpon').val();
        $.ajax({
             url:  "?c=ajax&m=infoNombreGalponLote",
            data: 'Nombre_Galpon='+Nombre_Galpon,
            type: 'GET',
            success: function(respuesta){
                if(!respuesta.error) {
                    // console.log(respuesta);
                    let datos = JSON.parse(respuesta);
                    $('#NumeroGallinas').val(datos[0].gallinas);
                    $.ajax({
                        url:  "?c=ajax&m=tabla",
                        data: 'Nombre_Galpon='+Nombre_Galpon,
                        type: 'GET',
                        success: function(respuestas){
                            if(!respuestas.error) {
                                let datos1 = JSON.parse(respuestas);
                                let html = '';
                               if (datos1 == false) {
                                    html = `<tr>
                                                <td></td>
                                                <td><p>Vacío</p></td>
                                                <td></td>
                                            </tr>`;
                               } else{
                                    let pos = 0;
                                    let suma = 0;
                                    for (var i = 0; i < datos1.length; i++) {
                                        suma += parseInt(datos1[i].numeroMuertes);
                                    }
                                    // for (let i = 0; i < datos1.length; i++) {
                                    //     suma = datos1[i].numeroMuertes
                                    // }
                                   Object.entries(datos1).forEach(([key, value]) => {
                                    // suma = datos1[key].numeroMuertes + suma;
                                        suma = suma - pos;
                                        pos = parseInt(value.numeroMuertes);
                                         html += `<tr>
                                                <td class = 'text-center'>${value.idLote}</td>
                                                <td class = 'text-center'>${value.fecha}</td>
                                                <td class = 'text-center'>${datos[0].gallinas- suma}</td>
                                              </tr>`;
                                     });
                                }
                                $('#Hola').html(html);
                            }
                        }
                    });
                } 
            }   
        });
    })

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
});

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