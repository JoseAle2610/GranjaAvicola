$(document).ready(function (){
	
    $(document).on('click', '.eliminarModuloTabla', (e) => {
        $(this)[0].activeElement.parentElement.parentElement.remove();
    });

  // VALIDAMOS QUE EXISTA POR LO MENOS UN MODULO
    $('#formularioAgregarGalpon').submit(e => {

        let datosModulo = document.getElementsByClassName('puntero');
        if (datosModulo.length == 0 || $('#NumeroGallinas').val() <= 0 || $('#numeroGalpon').val() <= 0) {
          e.preventDefault();
          alert('Debe existir por lo menos un módulo, el número de galpón y de gallinas no puede ser menor o igual a cero');
        }

    });

    $('#formularioEditarGalpon').submit(e => {

        let datosModulo     = document.getElementsByClassName('numeroModulo');
        let repetido = [];
        // ASEGURARSE DE QUE NO SE REPITA 
        // EL NOMBRE DEL MODULO
     
        for (let i = 0; i < datosModulo.length; i++) {
            if (repetido.includes(datosModulo[i].value) == true) {
                e.preventDefault();
                alert('El número del modulo no puede estar vacío ni repetido');
            }else{
                repetido.push(datosModulo[i].value);
            }
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
                    $('#editarNumeroGalpon')    .val(datos[0]['nombreGalpon']);
                    $('#editarIdGalpon')        .val(datos[0]['idGalpon']);
                    $('#editarIdLote')        .val(datos[0]['idLote']);
                    $('#editarInicioLote')      .val(datos[0]['inicio']);
                    $('#editarNumeroGallinas')  .val(datos[0]['gallinas']);
                    $('#loteActual')            .html(datos[0]['numeroLote'])
                    if (datos[0]['activo'] == 0) {
                        $('#activo')                .prop('checked', false);
                    } else $('#activo')                .prop('checked', true);
                    

                    $('#editarTablaModulos tbody').html('');
                    let posicion = 0;
                    datos.forEach(dato => {
                        let checked = (dato.sectorActivo == 1) ? 'checked':'';
                        let elementoTabla = $('#editarTablaModulos tbody').html();
                        elementoTabla += `<tr class=' p-0 '>
                                            <td>
                                            <div class="input-group d-flex">
                                                <label class='mt-1'>M-
                                                </label>
                                                <input type='number' class='form-control numeroModulo' name="modulos[${posicion}][nombreSector]" 
                                                value='${dato.nombreSector}'>
                                            </div>
                                                
                                            </td>
                                            <td class="justify-content-center d-flex">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="fila-${posicion}" 
                                                        name="modulos[${posicion}][activo]" ${checked}>
                                                    <label class="custom-control-label" for="fila-${posicion}">Activo</label>
                                                </div>
                                                <input type="hidden" value="${dato.idSector}" name="modulos[${posicion}][idSector]">
                                                <input type="hidden" value="editar" name="modulos[${posicion}][accion]">
                                            </td>
                                        </tr>`;
                        $('#editarTablaModulos tbody').html(elementoTabla);
                        posicion++;
                    });
                }
            }
        });
    });

    $('#agregarModulo').click(function(){
        AgregarModulo('#numeroModulo', '#tablaModulos tbody', 'puntero')
    });

    $('#editarModulo').click(function(){
        AgregarModulo('#editarNumeroModulo', '#editarTablaModulos tbody', 'numeroModulo')
    });

    function AgregarModulo(input, table, clase){
        let numeroModulo    = $(input).val();
        let datosModulo     = document.getElementsByClassName(clase);
        let posicion        = datosModulo.length;
        let repetido = false;
        // ASEGURARSE DE QUE NO SE REPITA 
        // EL NOMBRE DEL MODULO
        if (datosModulo.length != 0) {
          for (let i = 0; i < datosModulo.length; i++) {
            if (datosModulo[i].value == numeroModulo) {
              repetido = true;
            }
          }
        }
        // SI NO ESTA VACIO NI ESTA REPETIDO LO AGREGAMOS
        if (numeroModulo != '' && repetido == false) {
            let elementoTabla = $(table).html();
                elementoTabla += `<tr class=' p-0 '>
                                    <td>M-${numeroModulo}</td>
                                    <td class="justify-content-center d-flex">
                                        <button type="button" class="btn btn-danger form-control eliminarModuloTabla" >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <input type="hidden" name="modulos[${posicion}][nombreSector]" value="${numeroModulo}" class="${clase}">
                                        <input type="hidden" name="modulos[${posicion}][activo]" value="1">
                                        <input type="hidden" name="modulos[${posicion}][accion]" value="insertar">
                                    </td>
                                </tr>`;
            $(table).html(elementoTabla);
        } else {
          alert('El número del modulo no puede estar vacío ni repetido');
        }
    }

    $('.cambiarLote').click(function (){
        let idGalpon = $(this).attr('idGalpon');
        $.ajax({
            url:  "?c=ajax&m=infoGalpon",
            data: 'idGalpon='+idGalpon,
            type: 'GET',
            success: function(respuesta){
                let datos = JSON.parse(respuesta);
                $('#numeroGalponCL').val(datos[0]['nombreGalpon']);
                $('#idLoteCL').val(datos[0]['idLote']);
                $('#idGalponCL').val(datos[0]['idGalpon']);
                $('#numeroGallinasVL').val(datos[0]['gallinas']);
                $('#inicioLoteVL').val(datos[0]['inicio']);
            }
        });
    });

    $('#formularioCambiarLote').submit(e => {
        if ($('#inicioLoteNL').val() > $('#inicioLoteVL').val()) {
            let fecha = moment($('#inicioLoteVL').val()).add(630, 'days').format('YYYY-MM-DD');
            let fecha2 = moment($('#inicioLoteNL').val()).format('YYYY-MM-DD');
            if (fecha > $('#inicioLoteNL').val()) {
                fecha = moment(fecha);
                fecha2 = moment(fecha2);
                if (!confirm('Aún faltan '+(fecha.diff(fecha2, 'days'))+' semanas para que el lote anterior deba ser cambiado ¿Está seguro de que desea continuar?')) {
                    e.preventDefault();
                    alert('Se canceló el Cambio de Lote');
                }
            }  
        }else{
            e.preventDefault();
            alert('La fecha del nuevo lote no puede ser menor al lote anterior');
        }
    });
    // ----------------------------------------------
    // EDITANDO RESPONSABLE
    //----------------------------------------------
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
                    if (datos.ci == "v7427156") {
                        $('#activoResponsable').prop('disabled', true);
                        $('#NombreResponsable').prop('readonly', true);
                    } else $('#activoResponsable').prop('disabled', false);
                    if (datos.activo == 0) {
                        $('#activoResponsable').prop('checked', false);
                    }else{
                        $('#activoResponsable').prop('checked', true);
                    }
                    $('#Nacionalidad').val(datos.ci.substring(0,1));
                    $('#Cedula').val(datos.ci.substring(1)); 

                    $('#editar').val(true);

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
        $.ajax({
            url:  "?c=ajax&m=infoUsuario",
            data: 'idUsuarios='+idUsuarios,
            type: 'GET',
            success: function(respuesta){
                if (!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    console.log(respuesta);
                    // $('#Cedula_Usuario').val(datos[0].ci);
                    $('#claveUsuarioAgregar').val(datos[0].claveUsuario);
                    $('#nombreUsuarioAgregar').val(datos[0].nombreUsuario);
                    $('#RespuestaUsuarioAgregar').val(datos[0].respuesta);
                    if (datos[0].activo == 0) {
                        $('#activoUsuario').prop('checked', false);
                    }else{
                        $('#activoUsuario').prop('checked', true);
                    }
                    if (datos[0].nombreUsuario == 'Admin') {
                         $('#nombreUsuarioAgregar').prop('readonly', true);
                         $('#activoUsuario').prop('disabled', true);
                    }else{
                        $('#nombreUsuarioAgregar').prop('disabled', false);
                        $('#activoUsuario').prop('disabled', false);
                    }
                    $('#Cedula_Usuario').val(datos[0].ci);
                    $('#preguntaUsuarioAgregar').val(datos[0].pregunta);
                    $('#idUsuarios').val(datos[0].idUsuarios);
                    $('#editarUsuario').val(true);

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
                if(!respuesta.error || respuesta.length != 0) {
                    let datos = JSON.parse(respuesta);
                    $('#NumeroGallinas').val(datos[0].gallinas);
                    $('#NombreLote').html(datos[0].idLote);
                    if (datos[0].idLote != 0) {
                        $('#Active').prop('checked', true);
                    }
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
                                                <td class = 'text-center'>${value.numeroMuertes}</td>
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
        });
	});
    //----------------------------//
    // REPORTE PRODUCCION DIARIA  //
    //----------------------------//
    $('#buscarProduccionDiaria').click(function (){
        let fecha = $('#fechaProduccionDiaria').val();
        $.ajax({
            url: '?c=Ajax&m=produccionDiaria',
            data: 'fecha='+fecha,
            type: 'GET',
            success: function (respuesta) {
                if(!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    let valores = {1:0,2:0,3:0};
                    let cajasProducidas = {1:0,2:0,3:0};
                    datos.forEach(dato =>{
                        if (!valores.hasOwnProperty(dato.idCategoria)) {
                            valores[dato.idCategoria] = parseInt(dato.valor);
                            cajasProducidas[dato.idCategoria] = parseInt(dato.valor/360);
                        }else{
                            valores[dato.idCategoria] += parseInt(dato.valor)
                            cajasProducidas[dato.idCategoria] += parseInt(dato.valor/360);
                        }
                    });
                    let datosFilas = { 
                                        Producidas:     [], 
                                        Sobrantes:      [],
                                        Anexadas:       [],
                                        HuevosPorEncajarHoy:  [] 
                                    };
                    for(const fila in datosFilas){
                        
                        $(`.${fila}`).children().each(function (i, obj){
                            let clase = $(this).attr('class');
                            if(clase == `tipo-${i}`){
                                switch (fila){
                                    case 'Producidas':  valor = cajasProducidas[i];
                                                        break;
                                    case 'Sobrantes':   valor = valores[i]-(datosFilas.Producidas[i-1]*360)
                                                        break;
                                    case 'Anexadas':    valor = parseInt(datosFilas.Sobrantes[i-1]/360);
                                                        break;
                                    case 'HuevosPorEncajarHoy':valor = datosFilas.Sobrantes[i-1]-(datosFilas.Anexadas[i-1]*360);
                                                        break;
                                }
                                datosFilas[fila].push(valor);
                                $(this).html(valor);
                            }else if(clase == 'total'){
                                $(this).html(datosFilas[fila].reduce((a, b) => a + b, 0));
                            }
                        });
                    }
                }
            } 
        })
    });

    $('#nombreGalpon').change(function (){
        let idGalpon = $(this).val();
        $.ajax({
            url: '?c=Ajax&m=galponLotes',
            data: 'idGalpon='+idGalpon,
            type: 'GET',
            success: function (respuesta) {
              if(!respuesta.error) {
                let datos = JSON.parse(respuesta);
                console.log(datos);
                let html = '<option value="0">-Seleccionar-</option>';
                datos.forEach(dato => {
                  html += `<option value='${dato.idLote}' fechaInicio='${dato.inicio}' terminado='${dato.terminado}' class='lote'>
                                L-${dato.idLote}
                            </option>`;
                });
                $('#numeroLote').html(html);
              }
            } 
        });
    });

    $('#numeroLote').change(function (){
        // let fechaInicio = [];
        // let terminado = [];
        // $('.lote').each(function (i, obj){
        //     fechaInicio[i] = $(this).attr('fechaInicio');
        //     terminado[i] = $(this).attr('terminado');
        // });

    });

    $('#buscarFormatoDistribucion').click(function(){
        let idGalpon = $('#nombreGalpon').val();
        let idLote = $('#numeroLote').val();
        $.ajax({
            url: '?c=Ajax&m=formatoDistribucion&idLote='+idLote,
            data: 'idGalpon='+idGalpon,
            type: 'GET',
            success: function (respuesta) {
                if(!respuesta.error) {
                    let datos = JSON.parse(respuesta);
                    // console.log(datos);
                    let matriz = {};
                    datos.forEach((fila, x) => {
                        let filaMatriz = {};
                        if (!matriz.hasOwnProperty(fila.fecha)) {
                            matriz[fila.fecha] = {}; 
                            matriz[fila.fecha][fila.idCategoria] = parseInt(fila.valor);
                        }else {
                            if (!matriz[fila.fecha].hasOwnProperty(fila.idCategoria)) {
                                matriz[fila.fecha][fila.idCategoria] = parseInt(fila.valor);
                            }else{
                                matriz[fila.fecha][fila.idCategoria] += parseInt(fila.valor);
                            }
                        }
                    });//tr td:nth-child(1)
                    console.log(matriz)
                    $('#tablaFormatoDistribucion tbody ').html('');
                    for(const fecha in matriz){
                        // console.log(fecha);
                        let tr = $('#tablaFormatoDistribucion tbody ').html();
                        let td = `<td>${fecha}</td>`;
                        let totales = 0;
                        for (var i = 1; i <= 8 ; i++) {
                            if (matriz[fecha].hasOwnProperty(i)) {
                                td += `<td>${matriz[fecha][i]}</td>`;
                            }else{
                                td += `<td>0</td>`;
                                matriz[fecha][i] = 0;
                            }
                            totales += matriz[fecha][i];
                            if ( i == 3) {
                                td += `<td>${totales}</td>`;
                            } else if (i == 8) {
                                td += ` <td>${totales}</td>
                                        <td>${totales}</td>`
                            }
                        }
                        tr += `<tr>${td}</tr>`;
                        $('#tablaFormatoDistribucion tbody ').html(tr);
                    }
                }
            } 
        });
    })

    $('#imprimirProduccionDiaria').click(function (){
        var pdf = new jsPDF('p', 'pt', 'letter')
        var source = $('#ProduccionDiaria')[0]
        let fecha = $('#fechaProduccionDiaria').val().split('-');
        fecha = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
        var specialElementHandlers = {
            '#bypassme': function(element, renderer){
                return true
            }
        }

        margins = {
          top: 90,
          bottom: 60,
          left: 50,
          width: 522
        };
        pdf.setFontType('normal');
        pdf.text(150, 55, `Granja Avicola Las Tunas C.A.\nReporte Produccion Diaria\nFecha: ${fecha}`);
        // pdf.addImage($('#img')[0], 'png', 30, 20 , 100, 100);
        pdf.fromHTML(source, margins.left , margins.top
            , {
                'width': margins.width // max width of content on PDF
                , 'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                // pdf.save('Producción '+fecha+'.pdf');
                pdf.setProperties({ title: `Produccion ${fecha}.pdf` });
                window.open(pdf.output('bloburl', {filename:`Produccion ${fecha}.pdf`}), '_blank');
            },
            margins
        )
        
    });




});
