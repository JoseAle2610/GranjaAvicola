<div class="modal fade " id="editarGalpon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<div class="d-flex justify-content-between">
						<img src="assets/img/granero1.png" height="40px" class="mr-1">
						<h5 class="mt-2">Editar Galpón</h5>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=Galpon&m=AgregarGalpon" id="formularioEditarGalpon">
				<div class="modal-body">
					<div class="row">
						<!-- -------------------------------------------------------- -->
						<!-- AGREGAR style="position: sticky;top:100px" y Media query -->
						<!-- -------------------------------------------------------- -->
						<div class="col-12 col-md-6 mb-4 align-self-start">
							<div class="row">
								<div class="input-group col-9">
									<div class="input-group-prepend">
										<span class="input-group-text">Número de Galpón</span>
									</div>
									<input type="number" name="numeroGalpon" id="editarNumeroGalpon" class="form-control" min="1" max="100" required readonly>
								</div>
								<div class="col-3 align-self-center">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="activo" name="activo">
										<label class="custom-control-label" for="activo">Activo</label>
									</div>
								</div>		
							</div>
							<hr>
							<h6>Lote Actual: L-<span id="loteActual"></span></h6>
							<!-- ----------------------------------------------- -->
							<!-- AQUI COLOCAREMOS LOS DATOS DEL LOTE ACTUAL      -->
							<!-- ----------------------------------------------- -->
							<div id="loteActualDatos">
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<label for="editarInicioLote" class="input-group-text">Inicio</label>
									</div>
									<input type="date" name="inicioLote" id="editarInicioLote" class="form-control" min="2000-01-01" max="2030-12-31" required>
								</div>
								<div class="input-group form-group">
									<div class="input-group-prepend">
										<span class="input-group-text">N° Gallinas</span>
									</div>
									<input type="number" name="NumeroGallinas" id="editarNumeroGallinas" class="form-control" min="1" max="9000" required>
								</div>
							</div>
							<!-- -------------------------------------------------------------- -->
							<!-- INPUT HIDDEN ACCION PARA SABER QUE TIENE QUE HACEL EL SERVIDOR -->
							<!-- -------------------------------------------------------------- -->
								<input type="hidden" name="accionEditar" id="accionEditar" value="editar">
								<input type="hidden" name="editarIdGalpon" id="editarIdGalpon">
								<input type="hidden" name="editarIdLote" id="editarIdLote">
						</div>
						<div class="col-12 col-md-6">
							<div class="d-flex">
								<img src="assets/img/modules.png" height="35px">
								<p>Módulo</p>
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Número: </span>
								</div>
								<input class="form-control" type="number" name="editarNumeroModulo" id="editarNumeroModulo" min="1" max="100">
								<button type="button" id="editarModulo" class="btn btn-warning ml-2">Agregar</button>
							</div>
							<div class="row">
								<div class="col-12">
									<table id="editarTablaModulos" class="table  table-striped w-100">
										<thead class="bg-info">
											<th>Nombre Módulo</th>
											<th>Acción</th>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning"><i class="fas fa-save"></i></button>
					<a role="button" class="btn btn-danger text-white" data-dismiss="modal"><i class="fas fa-ban"></i></a>
				</div>
			</form>
		</div>
		<!--/.Content-->
	</div>
</div>
