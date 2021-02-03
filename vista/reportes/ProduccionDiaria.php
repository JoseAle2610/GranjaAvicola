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
							Reportes / Producción diaria
						</h5>
					</div>
						<button class="btn btn-warning text-dark" id="imprimirProduccionDiaria">
							<h5><i class="fas fa-print"></i></h5>
						</button>

					<!-- <button class="btn btn-info text-dark" data-toggle="modal" data-target="#AgregarResponsable">Agregar Responsable</button> -->
				</div>
				<div class="card-body" id="infoProduccionDiaria">
					<div class="row justify-content-center">
						
						<div class="col-md-8" id="ProduccionDiaria">
							<div class="form-row">
								<div class="col-md-10">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Fecha</span>
										</div>
										<input type="date" id="fechaProduccionDiaria" class="form-control" min="2000-01-01" value="<?php echo date("Y-m-d");?>" required>
									</div>
								</div>		
								<div class="col-md-2 mb-3">
									<button id="buscarProduccionDiaria" class="btn btn-info btn-block"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center bg-white rounded mx-5" id="ProduccionEntreDias">
						<div class="col-12" id="membreteReportes">
							<hr>
							<div class="row py-0">
								<div class="col-3">
									<img src="assets/img/Logo-imprimir.png" class="img-fluid" id="imgLogo" style="width: 7em">
								</div>
								<div class="col-6 align-self-center">
									<p class="text-center">
										<span class="h4">Granja Avicola Las Tunas C.A.</span><br>
										<span id="tituloReporte"></span>
									</p>
								</div>
								<div class="col-3">
										<p class="text-right">
											Fecha: <span id="fechaActualReporte"></span><br>
											Hora: <span id="horaActualReporte"></span>
										</p>
								</div>
							</div>
							<hr>
						</div>
						<div class="col-md-12 mt-3">
							<canvas id="myChart" class="bg-white rounded mx-auto" style="max-width: 900px"></canvas>
						</div>
						<div class="col-12 mt-3" >
							<!-- <label id="labelTabaProduccion" class="text-white">holas</label> -->
							<table class="table table-striped table-hover table-responsive-sm p-0">
								<thead class="bg-info" >
									<th>Cajas</th>
									<th>Tipo A</th>
									<th>Tipo B</th>
									<th>Tipo C</th>
									<th>Total</th>
								</thead>
								<tbody id="datosProduccionDiaria">
									<?php 
									$filas = array('Producidas', 
													'Anexadas',
													'Sobrantes', 
													'Huevos Por Encajar Hoy', );
									foreach ($filas as $key => $nombre): ?>
										<tr class='<?=str_replace(' ', '', $nombre)?>'>
											<td><?=$nombre?></td>
											<td class="tipo-1"></td>
											<td class="tipo-2"></td>
											<td class="tipo-3"></td>
											<td class="total"></td>
										</tr>
									<?php endforeach ?>
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