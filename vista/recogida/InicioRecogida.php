<!-- CONTAINER -->
<div class="container-lg my-3">
	<!-- <button class="btn btn-danger mt-3 ml-3" id='cerrar'><strong>X</strong></button> -->
	<div class="row">
		<div class="col-12">
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
					<div class="col-auto">
						<button class="btn btn-info btn-sm text-dark circulo py-0" data-toggle="modal" data-target="#Informacion"><h6 class="p-0"><i class="fas mt-2 fa-info"></i></h6></button>
						<button class="btn btn-warning text-dark agregarRecogida" data-toggle="modal" data-target="#guardarRecogida">Recogida de hoy<i class="fas fa-plus ml-2"></i></button>

					</div>
					
					<!-- <button class="btn btn-info text-dark" data-toggle="modal" data-target="#AgregarResponsable">Agregar Responsable</button> -->
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 px-1 ">
							<table class="table table-striped table-hover table-responsive p-0 tablas">

								<thead class="bg-orange text-dark text-center" >
									<th>Fecha Recogida</th>
									<th>Galpón</th>
									<th>Lote</th>
									<th>Módulo</th>
									<th>Responsable</th>
									<th>Grandes</th>
									<th>Medianos</th>
									<th>Pequeños</th>
									<th class="bg-info">Huevos Producidos</th>
									<th>Acción</th>
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
										echo "<td title='Suma de los huevos aptos para su venta'>$suma</td>";
										?>
										<td>
											<button title="Editar" class="btn btn-info infoRecogida btn-block" data-toggle="modal" data-target="#guardarRecogida" idRegistro='<?= $recogida->idRegistro?>'>
												<i class="fas fa-pen-fancy"></i>
											</button>
										</td>
									</tr>
								<?php endforeach ?>
										<!-- BUTTONS / MOSTRAR-EDITAR-ELIMINAR -->
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