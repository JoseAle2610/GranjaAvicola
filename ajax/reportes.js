$(document).ready( function (){


		var barChartData = {
			labels: [ 'G-1' , 'G-2'],
			datasets: [{
				label: 'Galpones',
				backgroundColor: [
	                    'rgba(255, 99, 132, .7)',
	                    'rgba(54, 162, 235, .7)',
	                    'rgba(255, 206, 86, .7)',
	                    'rgba(75, 192, 192, .7)',
	                    'rgba(153, 102, 255, .7)',
	                    'rgba(255, 159, 64, .7)'
	                ],
				borderWidth: 1,
				data: [0, 0]
			}]
		};
		var barChartOptios = {
			responsive: true,
			legend: {
				position: 'top',
			},
			title: {
				display: true,
				text: 'Producción entre Fechas'
			},
			scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
		};
		var barChart = {
			type: 'bar',
			data: barChartData,
			options: barChartOptios
		}

		window.onload = function() {
			var ctx = document.getElementById('myChart').getContext('2d');
			window.myBar = new Chart(ctx, barChart);

		};


    $('#formularioProduccionEntreDias').submit(e => {
    	e.preventDefault();
    	let fechaDesde = $('#fechaDesde').val();
    	let fechaHasta = $('#fechaHasta').val();
    	$.ajax({
            url:  "?c=ajax&m=produccionDiaria&fechaHasta="+fechaHasta,
            data: 'fechaDesde='+fechaDesde,
            type: 'GET',
            success: function(respuesta){
                let datos = JSON.parse(respuesta);
                let labelsGrafico = [];
                let datosGrafico = [];
                let tabla = {};
                let thead = `<th>Galpones</th>`;
                let tbody = '';
                datos.forEach(dato => {
                	let nombreGalpon = 'G-'+dato.nombreGalpon;
                	if (!labelsGrafico.includes(nombreGalpon)) {
                		labelsGrafico.push(nombreGalpon);
                	}
                	if (!tabla.hasOwnProperty(nombreGalpon)) {
                		tabla[nombreGalpon] = {};
                	}
                	if (!tabla[nombreGalpon].hasOwnProperty(dato.nombreCategoria)) {
                		tabla[nombreGalpon][dato.nombreCategoria] = parseInt(dato.valor);
                	}else{
                		tabla[nombreGalpon][dato.nombreCategoria] += parseInt(dato.valor);
                	}
                });

                Object.entries(tabla).forEach(([i, fila]) =>{
        			let tr = `<td>${i}</td>`;
            		Object.entries(fila).forEach(([j, columna]) => {
            			if (!thead.includes(j)) {
		                	thead += `<th>${j}</th>`;
            			}
            			tr += `<td>${columna}</td>`;
            		});
            		tbody += `<tr>${tr}</tr>`
                	datosGrafico.push(Object.values(fila).reduce((a, b) => a + b ));
                });

                let tablaHtml = `
				                <thead class='bg-info text-dark text-center'>
                					<tr>
                						<th colspan='9'>Detalles de la producción Entre fechas (${fechaDesde} / ${fechaHasta})</th>
                					</tr>
                					<tr>
                						${thead}
                					</tr>
				                </thead>
				                <tbody class='text-center'>
				                	${tbody}
				                </tbody>`;
				$('#tablaProduccionEntreDias').html(tablaHtml);

		        let hoy = new Date();
		        var dia = String(hoy.getDate()).padStart(2, '0');
        		var mes = String(hoy.getMonth() + 1).padStart(2, '0');
        		var hora = String(hoy.getHours() + 1).padStart(2, '0');
        		var min = String(hoy.getMinutes() + 1).padStart(2, '0');
		        $('#tituloReporte').html(`Producción entre fechas: ${cambiarFormatoFecha(fechaDesde)} / ${cambiarFormatoFecha(fechaHasta)}`);
		        $('#fechaActualReporte').html(`${dia}-${mes}-${hoy.getFullYear()}`);
		        $('#horaActualReporte').html(`${hora}:${min}`);
                barChartData.labels = labelsGrafico;
                barChartData.datasets[0].data = datosGrafico;

                window.myBar.update();
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
                    console.log(datos);
                    let lines = {};
                    let labels = {};
                    Object.values(datos).forEach( dato => {
                    	if (!lines.hasOwnProperty(dato.nombreCategoria)) {
                    		lines[dato.nombreCategoria] = parseInt(dato.valor);
                    		labels[dato.nombreCategoria] = dato.nombreCategoria;
                    	}else{
                    		lines[dato.nombreCategoria] += parseInt(dato.valor);
                    	}
                    });
                    console.log(Object.values(lines))
                    barChartData.labels = Object.values(labels);
                	barChartData.datasets[0].data = Object.values(lines);
                	barChart.type = 'bar';
					window.myBar.update();
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

    // $('#membreteReportes').hide();
    $('#imprimirReporte').click(function (){
        pdf('ProduccionEntreDias');
    });

    function pdf(elemento){
        const $elementoParaConvertir = $(`#${elemento}`)[0]; // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: [.7, 1, 1, 1],
                filename: 'producción.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    title: 'producion.pdf',
                    unit: "in",
                    format: "a3",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            // .setProperties({ title: `Produccion.pdf` })
            .output('bloburl', {filename:`Produccion.pdf`})
            .then(pdf => {
                window.open(pdf, '_blank')
            })
            .catch(err => console.log(err));
    }

	function cambiarFormatoFecha(fecha){
        fecha = fecha.split('-');
        return `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
    }
});
