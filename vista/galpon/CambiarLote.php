<div class="modal fade " id="CambiarLote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog " role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<div class="d-flex justify-content-between">
						<h5 class="mt-2">Cambiar Lote Del Galpon xn</h5>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=Galpon&m=cambiarLote" id="formularioCambiarLote">
				<div class="modal-body">
					<div class="row">
						<!-- -------------------------------------------------------- -->
						<!-- AGREGAR style="position: sticky;top:100px" y Media query -->
						<!-- -------------------------------------------------------- -->
						<div class="col-12 mb-4 align-self-start">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Numero galpon</span>
								</div>
								<input type="number" name="numeroGalponCL" id="numeroGalponCL" class="form-control" min="1" max="100" required readonly="">
								<input type="hidden" name="idLoteCL" id="idLoteCL">
								<input type="hidden" name="idGalponCL" id="idGalponCL">
								<input type="hidden" name="numeroGallinasVL" id="numeroGallinasVL">
								<input type="hidden" name="inicioLoteVL" id="inicioLoteVL">
							</div>
							<div class="row">
								<div class="col-4"><hr class="bg-warning"></div>
								<div class="col-4 text-center"><h6>Datos del nuevo lote</h6></div>
								<div class="col-4"><hr class="bg-warning"></div>
							</div>
							
							<div class="input-group mb-4">
								<div class="input-group-prepend">
									<label for="inicioLote" class="input-group-text">Inicio</label>
								</div>
									<input type="date" name="inicioLoteNL" id="inicioLoteNL" class="form-control" min="2000-01-01" value="<?php echo date("Y-m-d");?>" required>
								
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">N° Gallinas</span>
								</div>
								<input type="number" name="numeroGallinasNL" id="numeroGallinasNL" class="form-control" min="1" max="9000" required>
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
