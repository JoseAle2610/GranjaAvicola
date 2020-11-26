<!-- <button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarMortalidad">Agregar Mortalidad</button> -->
<!-- CONTAINER -->
<!-- CONTAINER -->
<div class="container my-3">
	<div class="row">
		<div class="col-12">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header d-flex justify-content-between">
					<h5 class="card-title">Control de Aves</h5>
					<div class="left">
						<!-- <button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarGalpon">Agregar Galpón</button> -->
					</div>
				</div>
				<div class="card-body">
					<form method="POST">
					<div class="row justify-content-between ">
						<div class="col-4">
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1">Galpón</span>
							  </div>
							  <select class="form-control">
							  	<option value="1" selected>1</option>
							  	<option value="1">2</option>
							  	<option value="1">3</option>
							  </select>
								<?php 
									// $this->GalponModelo = new GalponModelo();
									// select($this->GalponModelo->select(),'idGalpon'); 
								?>

							</div>
						</div>
						<div class="col-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<sapn class="input-group-text">N° Gallinas</sapn>
								</div>
								<input type="number" name="NumeroGallinas" id="NumeroGallinas" class="form-control" value="800" readonly>
							</div>
						</div>					
					</div>
					<div class="row mb-1 justify-content-center">
						<div class="col-5">
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1">Mortalidad</span>
							  </div>
							  <input type="number" class="form-control" min="1" max="800" required> 
							</div>
						</div>
						<div class="col-5">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Fecha</span>
								</div>
								<input type="date" class="form-control" name="FechaMortalidad" id="FechaMortalidad" min="2000-01-01" max="2020-12-31" value="2020-10-23" required>
							</div>
						</div>
						
					</div>
					<div class="row justify-content-center mb-2">
						<div class="col-5">
							<button class="btn btn-warning btn-block">Agregar</button>
						</div>
					</div>
					</form>
					<div class="row justify-content-center">
						<div class="col-3">
							<img src="assets/img/gallinaa.png" class="img-fluid">
						</div>
						<div class="col-6">
							<table class="table table-striped table-hover p-0 text-center ">
								<thead class="bg-orange text-dark">
									<th>Mortalidad</th>
									<th>Fecha</th>
									<th>Gallina restantes</th>
								</thead>
								<tbody>
									<tr>
										<td>10</td>
										<td>10/10/2020</td>
										<td>18934</td>
									</tr>
									<tr>
										<td>18</td>
										<td>11/10/2020</td>
										<td>18934</td>
									</tr>
									<tr>
										<td>5</td>
										<td>12/10/2020</td>
										<td>18934</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-3">
							<img src="assets/img/gallina1.png" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>
</div>
<!-- CONTAINER END -->