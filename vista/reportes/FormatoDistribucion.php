<!-- CONTAINER -->
<div class="container-lg">
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
							Reportes /  Formato de Distribucion
						</h5>
					</div>
					<button class="btn btn-warning text-dark" id="imprimirProduccionDiaria">
						<h5><i class="fas fa-print"></i></h5>
					</button>

					<!-- <button class="btn btn-info text-dark" data-toggle="modal" data-target="#AgregarResponsable">Agregar Responsable</button> -->
				</div>
				<div class="card-body" id="infoFormatoDistribucion">
					<div class="row">
						<div class="col-12">
							<div class="form-row">
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Galpon</span>
										</div>
										<select class="form-control" id="numeroGalpon">
											<option value="0">-Seleccionar-</option>
											<option value="1">G-1</option>
											<option value="2">G-2</option>
											<option value="3">G-3</option>
											<option value="4">G-4</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Lote</span>
										</div>
										<select class="form-control" id="numeroLote">
											<option value="0">-Seleccionar-</option>
											<option value="1">L-1</option>
											<option value="2">L-2</option>
											<option value="3">L-3</option>
											<option value="4">L-4</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Mes</span>
										</div>
										<input type="month" id="fechaProduccionDiaria" class="form-control" value="<?php echo date("Y-m");?>" required>
									</div>
								</div>
								<div class="col-md-2">
									<button id="buscarProduccionDiaria" class="btn btn-info btn-block"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="col-12" id="ProduccionDiaria">
							<table class="table table-striped table-hover table-responsive-lg p-0">
								<thead class="bg-info">
									<th>Fecha</th>
									<th>Grandes</th>
									<th>Medianos</th>
									<th>Pequeños</th>
									<th>Total huevos Producidos</th>
									<th>Picados</th>
									<th>Debil</th>
									<th>Derramados</th>
									<th>Rusticos</th>
									<th>Pool</th>
									<th>Total</th>
									<th>% Postura</th>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div id="bypassme"></div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>
<!-- CONTAINER END -->
</div>