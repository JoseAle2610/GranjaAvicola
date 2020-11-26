<div class="modal fade " id="AgregarResponsable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-info text-white">
				<p class="heading lead">Agregar Responsable</p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=Recogida&m=AgregarResponsable">
				<div class="modal-body">
					
					<div class="form-group row">
						<div class="col-md-6 mb-2">
							<div class="input-group">
								<span class="input-group-addon">Nombre</span>
								<input type="text" name="nombreResponsable" id="nombreResponsable" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">Apellido</span>
								<input type="text" name="apellidoResponsable" id="apellidoResponsable" class="form-control" required>
							</div>
						</div>
					</div>
					
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">Guardar</button>
					<a role="button" class="btn btn-danger text-white" data-dismiss="modal">Cancelar</a>
				</div>
			</form>
		</div>
		<!--/.Content-->
	</div>
</div>