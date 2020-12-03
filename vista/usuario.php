<!-- MODAL RESPONSABLE -->
<div class="modal fade " id="Usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog  modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<h5><i class="fas fa-users mr-1"></i>Usuarios<i class="fas fa-users ml-1"></i></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=usuario&m=guardarUsuario">
				<div class="modal-body">
					<div class="row justify-content-center">
						<div class="col-12 col-md-6">
							<div class="row">
								<div class="col-9">
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text text-white bg-dark">Cédula</span>
										</div>
										<?php
										$ResponsableModel = new ResponsableModelo();
										$select = "<select class='form-control' name='Cedula_Usuario' id='Cedula_Usuario'>";
												foreach ($ResponsableModel->select() as $key => $registro) {
												$select .= "<option value='$registro->ci'>$registro->ci</option>";
												}
										$select .= '</select>';
										echo $select;
										
										?>
									</div>
								</div>
								<div class="col-3 mt-2">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="activoUsuario" name="activoUsuario" checked="" disabled>
										<label class="custom-control-label" for="activoUsuario">Activo</label>
									</div>
								</div>
								<div class="col-9">
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text text-white bg-dark">Usuario</span>
										</div>
										<input type="text" name="nombreUsuarioAgregar" id="nombreUsuarioAgregar" class="form-control" required minlength="4" maxlength="20">
									</div>
								</div>
								<div class="col-9">
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text text-white  bg-dark">Clave</span>
										</div>
										<input type="password" name="claveUsuarioAgregar" id="claveUsuarioAgregar" class="form-control" required minlength="4" maxlength="20">
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 mt-4">
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text text-white bg-dark">Pregunta</span>
								</div>
								<select class='form-control' name='preguntaUsuarioAgregar' id='preguntaUsuarioAgregar'>
									<option value="Nombre de tu mejor amigo">Nombre de tu mejor amigo</option>
									<option value="Nombre de tu mama">Nombre de tu mamá</option>
									<option value="Fecha de nacimiento de tu abuela">Fecha de nacimiento de tu abuela</option>
									<option value="Videojuego Favorito">Videojuego Favorito</option>
								</select>
								
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text text-white bg-dark">Respuesta</span>
								</div>
								<input type="text" name="RespuestaUsuarioAgregar" id="RespuestaUsuarioAgregar" class="form-control" required minlength="4" maxlength="20">
							</div>
							<!-- EDITAR -->
							<input type="hidden" id="editarUsuario" name="editarUsuario" value="0">
							<input type="hidden" name="idUsuarios" id="idUsuarios">
						</div>
						
						
						<div class="col-12">
							<!-- -------------------------------------- -->
							<!-- CONSULTA Usuario                      -->
							<!-- -------------------------------------- -->
							<table class="table table-striped table-responsive-md">
								<thead class="bg-info text-dark">
									<th>Estado</th>
									<th>Cédula</th>
									<th>Nombre Usuario</th>
									<th>Clave</th>
									<th>Fecha Creación</th>
									<th>Pregunta</th>
									<th>Respuesta</th>
									<th>Acción</th>
								</thead>
								<tbody>
									<?php
									$UsuarioModelo = new UsuarioModelo();
									foreach ($UsuarioModelo->select() as $key => $value): ?>
									<tr>
										<td>
											<span class="badge badge-<?=$value->activo ? 'info' : 'danger' ;?>">
												<?=$value->activo ? 'Activo' : 'Inactivo' ;?>
											</span>
										</td>
										<td><?=$value->ci?></td>
										<td><?=$value->nombreUsuario?></td>
										<td><?=$value->claveUsuario?></td>
										<td><?=cambiarFormatoFecha($value->fechaCreacion)?></td>
										<td><?=$value->pregunta?></td>
										<td><?=$value->respuesta?></td>
										<td class="btn-group justify-content-center d-flex">
											<button type="button"class="btn btn-danger editarUsuario"
											idUsuarios ='<?=$value->idUsuarios?>'>
											<i class="fas fa-pen-fancy"></i>
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