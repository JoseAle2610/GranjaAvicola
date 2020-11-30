<!-- CONTAINER -->
<div class="container">
	<!-- <button class="btn btn-danger mt-3 ml-3" id='cerrar'><strong>X</strong></button> -->
	<div class="row">
		<div class="col-12 my-3">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<img src="assets/img/huevos.png" height="40px" class="mr-1 ">
						<h5 class="card-title mt-0 mt-md-2">
							Recogida / Actividad en los últimos días
						</h5>
					</div>
					
					<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarRecogida">Recogida de hoy<i class="fas fa-plus ml-2"></i></button>

					<!-- <button class="btn btn-info text-dark" data-toggle="modal" data-target="#AgregarResponsable">Agregar Responsable</button> -->
				</div>
				<div class="card-body">
					<div class="row mb-3 justify-content-center">
						<div class="col-6 col-md-4">
							<div class="input-group mb-3 mb-md-0">
								<div class="input-group-prepend">
									<span class="input-group-text">Galpón</span>
								</div>
								<select class="form-control" id="NumeroGalpon">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
								</select>
							</div>
						</div>
						<div class="col-6 col-md-4">
							<div class="input-group mb-3 mb-md-0">
								<div class="input-group-prepend">
									<span class="input-group-text">Tiempo</span>
								</div>
								<select class="form-control" id="Tiempo">
									<option value="3">Día</option>
									<option value="2">Mes</option>
									<option value="1">Año</option>
								</select>
							</div>
						</div>
						<div class="col-6 col-md-2">
							<button class="btn btn-info btn-block" data-toggle="modal" data-target="#Alerta"><i class="fas fa-search"></i></button>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<table class="table table-striped table-hover table-responsive-xl p-0 ">

								<thead class="bg-orange text-dark text-center" >
									<th>Fecha Recogida</th>
									<th>Galpón</th>
									<th>Lote</th>
									<th>Modulo</th>
									<th>Responsable</th>
									<th>Grandes</th>
									<th>Medianos</th>
									<th>Pequeños</th>
									<th class="bg-info">Huevos Producidos</th>
								</thead>
								<tbody>
								<?php foreach ($recogidas as $recogida): ?>
									<tr>
										<td><?=cambiarFormatoFecha($recogida->fecha)?></td>
										<td>G-<?=$recogida->nombreGalpon?></td>
										<td>L-<?=$recogida->numeroLote?></td>
										<td>M-<?=$recogida->nombreSector?></td>
										<td><?=$recogida->ci?></td>
										<?php 
										$grandes = 0;
										$medianos = 0;
										$pequeños = 0;
										foreach ($recogida->valores as $valores) {
											foreach ($valores as $key => $valor) {
												if ($key == 1) {
													$grandes += $valor;
												}elseif ($key == 2) {
													$medianos += $valor;
												}elseif ($key == 3) {
													$pequeños += $valor;
												}
											}
										}
										echo "<td>$grandes</td>";
										echo "<td>$medianos</td>";
										echo "<td>$pequeños</td>";
										$suma = $grandes + $pequeños + $medianos;
										echo "<td>$suma</td>";
										?>
									</tr>
								<?php endforeach ?>
										<!-- BUTTONS / MOSTRAR-EDITAR-ELIMINAR -->
										<!-- <td class="btn-group p-0">
											<button class="btn btn-info" data-toggle="modal" data-target="#DetallesRecogida"></button>
											<button class="btn btn-warning" data-toggle="modal" data-target="#EditarRecogida"></button>
											<button class="btn btn-danger"data-toggle="modal" data-target="#EliminarRecogida"></button>
										</td> -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>

<!-- CONTAINER END -->
</div>