<!-- MODAL RESPONSABLE -->
<div class="modal fade " id="Usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog" role="document">
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
			<form method="post" action="?c=recogida&m=agregarUsuario">
				<div class="modal-body">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text text-white bg-dark">Nombre</span>
						</div>
						<input type="text" name="nombreUsuarioAgregar" id="nombreUsuarioAgregar" class="form-control" pattern="[a-zA-Z ]+" maxlength="4" maxlength="20" required>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text text-white  bg-dark">Clave</span>
						</div>
						<input type="password" name="claveUsuarioAgregar" id="claveUsuarioAgregar" class="form-control" required minlength="4" maxlength="20">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text text-white bg-dark">Rol</span>
						</div>
						<select name="RolAgregar" id="RolAgregar" class="form-control">
							<option value="1">Admin</option>
							<option value="1">Responsable</option>
						</select>
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