<!-- CONTAINER -->
<div class="container-lg">
	<div class="row">
		<div class="col-12 my-3">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<img src="assets/img/huevos.png" height="40px" class="mr-1 ">
						<h5 class="card-title mt-0 mt-md-2">
							Reportes / Producción entre fechas
						</h5>
					</div>
						<button class="btn btn-warning text-dark" id="imprimirProduccionDiaria">
							<h5><i class="fas fa-print"></i></h5>
						</button>
				</div>
				<div class="card-body" id="infoProduccionDiaria">
					<div class="row p-3">
						<div class="col-12">
							<form class="form-row">
								<div class="col-md-5">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Desde</span>
										</div>
										<?php 
											$fecha = date('Y-m-d');
											$nuevafecha = strtotime ( '-5 day' , strtotime ( $fecha ) ) ;
											$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
											// echo $nuevafecha;
										?>
										<input type="date" id="DesdeProduccion" class="form-control" min="2000-01-01" value="<?php echo $nuevafecha;?>" required>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Hasta</span>
										</div>
										<input type="date" id="hastaProduccion" class="form-control" min="2000-01-01" max="<?=$fecha?>" value="<?=$fecha?>" required>
									</div>
								</div>		
								<div class="col-md-2 mb-3">
									<button id="buscarProduccionEntreFechas" class="btn btn-info btn-block"><i class="fas fa-search"></i></button>
								</div>
							</form>
						</div>
						<div class="col-md-10 bg-white rounded">
							<canvas id="myChart"></canvas>
						</div>

						<div class="col-md-1">
							<!-- <img src="assets/img/huevos1.png" class="img-fluid"> -->
							<img src="assets/img/Logo.png" class="d-none" id="img">
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