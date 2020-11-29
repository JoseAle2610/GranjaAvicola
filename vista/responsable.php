<!-- MODAL RESPONSABLE -->
<div class="modal fade " id="Responsables" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<h5><i class="fas fa-users mr-1"></i>Responsables<i class="fas fa-users ml-1"></i></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=responsable&m=guardarResponsable">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-5 align-self-center">
							<!-- -------------------------------------- -->
							<!-- DATOS DEL RESPONSABLES                 -->
							<!-- -------------------------------------- -->
							<!-- CEDULA -->
							<div class="form-row">
								<div class="input-group form-group col-9">
									<div class="input-group-prepend">
										<span class="input-group-text text-white bg-dark">Cédula</span></div>
									<select name="Nacionalidad" id="Nacionalidad" class="form-control" style="max-width: 5em">
										<option value="v">V</option>
										<option value="e">E</option>
									</select>
									<input type="number" name="Cedula" id="Cedula" class="form-control" min="3000000" max="40000000" required>
								</div>
								<div class="col-3">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="activoResponsable" name="activoResponsable">
										<label class="custom-control-label" for="activoResponsable">Activo</label>
									</div>
								</div>
							</div>
							<!-- NOMBRE RESPONSABLE -->
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text text-white  bg-dark">Nombre</span>
								</div>
								<input type="text" name="NombreResponsable" id="NombreResponsable" class="form-control" required pattern="[a-zA-Z ]+" minlength="3" maxlength="40">
							</div>
							<!-- APELLIDO RESPONSABLE -->
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text text-white  bg-dark">Apellido</span>
								</div>
								<input type="text" name="ApellidoResponsable" id="ApellidoResponsable" class="form-control" pattern="[a-zA-Z ]+" minlength="3" maxlength="40">
							</div>
							<!-- PAGINA ACTUAL -->
							<input type="hidden" name="pagina" value="<?=$_REQUEST['c']?>">
							<!-- EDITAR -->
							<input type="hidden" name="editar" id="editar" value="0">
						</div>
						<div class="col-md-7">
							<!-- -------------------------------------- -->
							<!-- CONSULTA RESPONSABLES                      -->
							<!-- -------------------------------------- -->
							<table class="table table-striped table-responsive">
								<thead class="bg-info text-dark">	
									<th>Estado</th>
									<th>Cédula</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Acción</th>
								</thead>	
								<tbody>
								<?php 
								$responsableModelo = new ResponsableModelo();
								foreach ($responsableModelo->select() as $key => $value): ?>
									<tr>
										<td>
											<span class="badge badge-<?=$value->activo ? 'info' : 'danger' ;?>">
												<?=$value->activo ? 'Activo' : 'Inactivo' ;?>
											</span>
										</td>
										<td><?=$value->ci?></td>
										<td><?=$value->nombreResponsable?></td>
										<td><?=$value->apellidoResponsable?></td>
										<td class="btn-group justify-content-center d-flex">
											<button type="button" data-toggle="modal" data-target="#Alerta" class="btn btn-info"><i class="fas fa-search-plus"></i></button>
											<button type="button"class="btn btn-warning editarResponsable"
													ci='<?=$value->ci?>'>
												<i class="fas fa-pen-fancy"></i>
											</button>
											<button type="button"class="btn btn-danger eliminarResponsable" ci='<?=$value->ci?>'>
												<i class="fas fa-trash-alt"></i>
											</button>
										</td>
									</tr>
								<?php endforeach ?>
								</tbody>			
							</table>
						</div>
					</div>
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="submit" class="btn btn-info"><h5><i class="fas fa-save"></i></h5></button>
					<a role="button" class="btn btn-danger text-white" data-dismiss="modal"><h5><i class="fas fa-ban"></i></h5></a>
				</div>
			</form>
		</div>
		<!--/.Content-->
	</div>
</div>