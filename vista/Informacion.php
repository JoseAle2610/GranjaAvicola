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
			<div class="row p-3 text-justify">
				<div class="col "> 
					<?php
					if (isset($_REQUEST['c'])) {
					$Mensaje = "Módulo creado con la finalidad de observar ";
					if (isset($Galpon) && empty($Galpon)) {
						$Mensaje = "<h1 class='p-0 text-center'><i class='fas fa-egg'></i></h1><br><h5 class='text-center'>¡Bienvenido ".$_SESSION['nombreUsuario']."!</h5><br> Recuerda que para poder agregar alguna recogida primeramente debes de tener ingresado un Galpón, por lo que te invito a que agregues alguno <a href='?c=Galpon' class='text-info'>aquí</a>.";
					}else if ($_REQUEST['c'] == "recogida") {
						$Mensaje .= "las actividades realizadas en cada uno de los módulos de los galpones existentes. <br> Ofrece la opción de buscar por cada una de las columnas de la tabla algún dato indicandole la información precisa que quiere hallar. <hr> <button type='Button' class='ml-2 btn btn-warning text-dark' >Recogida de hoy<i class='fas fa-plus ml-2'></i></button> Nos muestra el modal que nos permite agregar alguna recogida, para ello recuerda indicar primero el galpón y luego podrás elegir su módulo. <br> <br> <button type='Button' class='ml-2 btn btn-info'><i class='fas fa-pen-fancy'></i></button> Este otro botón nos muestra la información proporcionada con anterioridad y nos deja modificarla. <br> ";
					} else if($_REQUEST['c'] == "Galpon"){
						$Mensaje .= "los distintos Galpones que han sido creados, junto a los módulos por los que se compone, su estado (activo o inactivo), el lote activo hasta el momento y su fecha de inicio. <hr> <button type='Button' class='ml-2 btn btn-warning text-dark'><i class='fas fa-plus'></i></button> Botón que nos muestra el modal que nos permite agregar a algún galpón tras indicarle su número, la fecha del lote con el que empieza junto a sus gallinas respectivas, al igual que los módulos por los que se compone. <br> <button type='Button' class='ml-2 btn btn-info'><i class='fas fa-exchange-alt pl-1'>Lote</i> </button> Por otra parte, este botón que permite cambiar el lote del galpón al que se le presionó el mismo, para ello se le debe de indicar la fecha en la que se incia el nuevo lote y la cantidad de gallinas por el que está compuesto. <br> <button type='Button' class='ml-2 btn btn-danger'><i class='fas fa-pen-fancy'></i></button> Y por último se encuentra este otro botón, que tras presionarlo saldrá un modal que muestra la información proporcionada con anterioridad y nos deja modificarla.";
					} else if($_REQUEST['c'] == "ControlAves"){
						$Mensaje .= "y actualizar la mortalidad de las gallinas pertenecientes al galpón indicado, divisando el N° Gallinas con el que empezó y con el que se dispone ahora en la tabla, más específicamente en su primera fila";
					}
					echo "<p class='p-2' ><strong>$Mensaje</strong></p>";
					}else echo "NOOOOOOOOO";
					?>
				</div>
			</div>
		</div>
	</div>
</div>