$(document).ready( function (){
	$(".tablas").DataTable({
	// responsive: true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

	});

	var MONTHS = ['November', 'December'];
		// var color = Chart.helpers.color;
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
		window.onload = function() {
			var ctx = document.getElementById('myChart').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: barChartOptios
			});

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

	function cambiarFormatoFecha(fecha){
        fecha = fecha.split('-');
        return `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
    }

});
