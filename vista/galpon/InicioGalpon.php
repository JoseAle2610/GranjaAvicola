<!-- CONTAINER -->
<div class="container my-3">
	<div class="row">
		<div class="col-12">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<img src="assets/img/granero1.png" height="35px" class="mr-1">
						<h3>Galpón</h3>
					</div>
					
					<div class="left">
						<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarGalpon"><i class="fas fa-plus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<form method="POST">
					<div class="row justify-content-center">
						<div class="col-6">
							<div class="input-group">
								<input class="form-control " type="text" minlength="1" maxlength="8" pattern="[0-9]+" required>
								<button class="form-control btn btn-info">Buscar</button>
							</div>
						</div>
					</div>
					</form>
					<div class="row p-3">
						

						<!-- <div class="col-12 mb-2">
							<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarGalpon">Agregar Galpon</button>

							<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarGalponLote">Agregar Galpon a Lote</button>

							<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarSector">Agregar Sector</button>

							<button class="btn btn-danger text-dark" data-toggle="modal" data-target="#SacarLote">Sacar Lote</button>
						</div> -->
						<div class="col">
							<table class="table table-striped table-responsive-sm p-0 tablas">
								<thead class="bg-orange text-dark" >
									<th>Nombre</th>
									<th>N° gallinas actuales</th>
									<th>Lote Activo</th>
									<th>Huevos recolectados</th>
									<th>Acción</th>
								</thead>
								<tbody>
									<tr>
										<td>G-1</td>
										<td>18567</td>
										<td>1</td>
										<td>35283</td>
										<!-- BUTTONS / MOSTRAR-EDITAR-ELIMINAR -->
										<td class="btn-group justify-content-center d-flex">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#DetalleGalpon"><i class="fas fa-search-plus"></i></button>
											<button class="btn btn-warning" data-toggle="modal" data-target="#Alerta"><i class="fas fa-pen-fancy"></i></button>
											<button class="btn btn-danger text-dark"data-toggle="modal" data-target="#Alerta"><i class="fas fa-trash-alt text-dark"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>
</div>
<!-- CONTAINER END -->