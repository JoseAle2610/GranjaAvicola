<div class="modal fade " id="AgregarSector" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-warning">
				<p class="heading lead">Agregar Galpon</p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=Galpon&m=agregarSector">
				<div class="modal-body">
					
					<div class="form-group row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">Galpon</span>
								<option value="1">G-1</option>
								<option value="2">G-2</option>
								<option value="3">G-3</option>
								<option value="4">G-4</option>
								<option value="5">G-5</option>
								<option value="6">G-6</option>
								<option value="7">G-7</option>
								<option value="8">G-8</option>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">Nombre</span>
								<input type="text" name="nombreSector" class="form-control">
							</div>
						</div>
					</div>
					
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning">Guardar</button>
					<a role="button" class="btn btn-danger text-white" data-dismiss="modal">Cancelar</a>
				</div>
			</form>
		</div>
		<!--/.Content-->
	</div>
</div>