<div class="modal fade " id="Informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<!--Content-->
		<div class="modal-content bg-dark text-white">
			<!--Header-->
			<div class="row justify-content-between">
				<div class="col-auto ml-2 mt-1 d-flex">
					<h4><i class="fas fa-info-circle"></i></h4><h5>nformación</h5>
				</div>
				<div class="col-2 mr-2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">&times;</span></button>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<?php
					if (isset($_REQUEST['c'])) {
					$Mensaje;
					if ($_REQUEST['c'] == "recogida") {
						$Mensaje = "Módulo creado con la finalidad de observar las actividades realizadas en cada uno de los módulos de los galpones existentes. <br> Ofrece la opción de buscar por cada una de las columnas de la tabla algún dato indicandole la información precisa que quiere hallar. <br> <br> <button type='Button' class='btn btn-warning text-dark' >Recogida de hoy<i class='fas fa-plus ml-2'></i></button> Nos muestra el modal que nos permite agregar alguna recogida, para ello recuerda indicar primero el galpón y luego podrás elegir su módulo. <br> <br> <button type='Button' class='btn btn-info'><i class='fas fa-pen-fancy'></i></button> Este otro botón nos muestra la información proporcionada con anterioridad y nos deja modificarla. <br> ";
					} else if($_REQUEST['c'] == "Galpon"){
						$Mensaje = "Módulo creado con la finalidad de observar los distintos Galpones que han sido creados, junto a los módulos por los que se compone, su estado (activo o inactivo), el lote activo hasta el momento y su fecha de inicio. <br> <button type='Button' class='btn btn-warning text-dark'><i class='fas fa-plus'></i></button> Botón que nos muestra el modal que nos permite agregar a algún galpón tras indicarle su número, la fecha del lote con el que empieza junto a sus gallinas respectivas, al igual que los módulos por los que se compone. <br> <button type='Button' class='btn btn-info'><i class='fas fa-exchange-alt pl-1'>Lote</i> </button> Por otra parte, este botón que permite cambiar el lote del galpón al que se le presionó el mismo, para ello se le debe de indicar la fecha en la que se incia el nuevo lote y la cantidad de gallinas por el que está compuesto. <br> <button type='Button' class='btn btn-danger'><i class='fas fa-pen-fancy'></i></button> Y por último se encuentra este otro botón, que tras presionarlo saldrá un modal que muestra la información proporcionada con anterioridad y nos deja modificarla.";
					} else if($_REQUEST['c'] == "ControlAves"){
						$Mensaje = "Módulo creado con la finalidad de observar y actualizar la mortalidad de las gallinas pertenecientes al galpón indicado, divisando el N° Gallinas con el que empezó y con el que se dispone ahora en la tabla, más específicamente en su primera fila";
					}
					echo "<p class='ml-2 mr-2' ><strong>$Mensaje</strong></p>";
					}else echo "NOOOOOOOOO";
					?>
				</div>
			</div>
		</div>
	</div>
</div>