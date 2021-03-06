<!-- CONTAINER -->
<div class="container-lg my-3">
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
					
					<div class="col-auto">
						<button class="btn btn-info btn-sm text-dark circulo py-0" data-toggle="modal" data-target="#Informacion"><h6 class="p-0"><i class="fas mt-2 fa-info"></i></h6></button>
						<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarGalpon"><i class="fas fa-plus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						
						<div class="col px-1 ">
							<table class="table table-striped table-responsive-lg p-0 tablas">
								<thead class="bg-orange text-dark" >
									<th>Estado</th>
									<th>Nombre</th>
									<th>N° gallinas actuales</th>
									<th>Lote Activo</th>
									<th>Inicio del Lote</th>
									<th>Módulos</th>
									<th>Acción</th>
								</thead>
								<tbody>
									<?php foreach ($this->galpones as $key => $value): ?>
									<tr id="<?=$value->idGalpon?>">
										<td>
											<span class="badge badge-<?=$value->activo ? 'info' : 'danger' ;?>">
												<?=$value->activo ? 'Activo' : 'Inactivo' ;?>
											</span>
										</td>
										<td>G-<?=$value->nombreGalpon?></td>
										<td><?=$value->gallinas?></td>
										<td><?=$value->numeroLote?></td>
										<td><?=cambiarFormatoFecha($value->inicio)?></td>
										<td><?=$value->cantModulos?></td>
										<!-- BUTTONS / MOSTRAR-EDITAR-ELIMINAR -->
										<td class="btn-group justify-content-center d-flex">
											<button idGalpon='<?=$value->idGalpon?>' class="btn btn-info cambiarLote" data-toggle="modal" data-target='#CambiarLote'><i class="fas fa-exchange-alt pl-1">Lote</i> </button>
											<button idGalpon='<?=$value->idGalpon?>' class="btn btn-danger editarGalpon" data-toggle="modal" data-target='#editarGalpon'><i class="fas fa-pen-fancy"></i></button>
										</td>
									</tr>
									<?php endforeach ?>
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