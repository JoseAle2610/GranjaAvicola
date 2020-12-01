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
					<form method="POST" action="?c=controlAves&m=AgregarMortalidad">
						<div class="row justify-content-between ">
							<div class="col-8 col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Galpón</span>
									</div>
									<?php
												$GalponModelo = new GalponModelo();
												$select = "<select class='form-control' name='Nombre_Galpon' id='Nombre_Galpon'>";
												foreach ($GalponModelo->select() as $key => $registro) {
												$select .= "<option value='$registro->id'>$registro->nombre</option>";
												}
												$select .= '</select>';
												echo $select;
												
									?>
									<?php
										// $this->GalponModelo = new GalponModelo();
										// select($this->GalponModelo->select(),'idGalpon');
									?>
								</div>
							</div>
							<div class="col-2 mt-4 mt-md-0">
								<button type="button" class="btn btn-info btn-block BuscarGalpon"><i class="fas fa-search"></i></button>
							</div>
							
							<div class="col-8 col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<sapn class="input-group-text">N° Gallinas</sapn>
									</div>
									<input type="number" name="NumeroGallinas" id="NumeroGallinas" class="form-control" value="800" readonly>
								</div>
							</div>
							
						</div>
						<div class="row mb-1 justify-content-center">
							<div class="col-8 col-md-5">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Mortalidad</span>
									</div>
									<input type="number" class="form-control" min="1" max="90000" required id="Mortalidad" name="Mortalidad">
								</div>
							</div>
							<div class="col-8 col-md-5">
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
								<tbody id="Hola">
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