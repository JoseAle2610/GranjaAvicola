<!-- CONTAINER -->
<div class="container">
	<!-- <button class="btn btn-danger mt-3 ml-3" id='cerrar'><strong>X</strong></button> -->
	<div class="row">
		<div class="col-12 my-3">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header d-flex justify-content-between">
					<h5 class="card-title mt-2">
						<i class="fas fa-clipboard"></i>Reportes / Cierre de mes
					</h5>
					<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#Alerta"><h5><i class="fas fa-print"></i></h5></button>

					<!-- <button class="btn btn-info text-dark" data-toggle="modal" data-target="#AgregarResponsable">Agregar Responsable</button> -->
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-md-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Año</span>
								</div>
								<select class="form-control" id="Año">
									<option value="1">2020</option>
									<option value="2">2019</option>
									<option value="3">2018</option>
									<option value="4">2017</option>
									<option value="5">2016</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Mes</span>
								</div>
								<select class="form-control" id="Mes">
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="3">Abril</option>
									<option value="3">Mayo</option>
									<option value="3">Junio</option>
									<option value="3">Julio</option>
									<option value="3">Agosto</option>
									<option value="3">Septiembre</option>
									<option value="3">Octubre</option>
									<option value="3">Noviembre</option>
									<option value="3">Diciembre</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#Alerta"><i class="fas fa-search"></i></button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9">
							<table class="table table-responsive-sm p-0 text-center">

								<thead class="bg-success text-dark">
									<th></th>
									<th>Tipo A</th>
									<th>Tipo B</th>
									<th>Tipo C</th>
								</thead>
								<tbody class="bg-white">
									<tr>
										<td><strong>Inventario Inicial</strong></td>
										<td>1388</td>
										<td>335</td>
										<td>4</td>
									</tr>
									<tr>
										<td><strong>Cajas Producidas</strong></td>
										<td>5100</td>
										<td>1181</td>
										<td>49</td>
									</tr>
									<tr>
										<td><strong>Inventario Final</strong></td>
										<td>436</td>
										<td>105</td>
										<td>1</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-3">
							<img src="assets/img/gallina.png" class="img-fluid">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-white h5 ">Inventario Inicial:</div>
						<div class="col-md-4 text-white h5 ">Cajas Producidas:</div>
						<div class="col-md-4 text-white h5 ">Inventario Final:</div>
					</div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>
<!-- CONTAINER END -->
</div>