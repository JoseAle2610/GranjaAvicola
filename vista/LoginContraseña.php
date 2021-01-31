<div class="modal fade " id="CambiarContra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog " role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<div class="d-flex justify-content-between">
					<h5 class="mt-2">Recuperar Contraseña</h5>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=Login&m=CambiarContra" id="formularioCambiarContra">
				<div class="modal-body">
					<div class="row justify-content-center text-center">
						<div class="col-7">
							<div class="form-group">
								<strong class="d-block text-center">Usuario</strong>
								<input type="text" id="nombreUsuarioRecuperar" name="nombreUsuarioRecuperar" class="form-control" required minlength="4" maxlength="20">
							</div>
						</div>
						<div class="col-3 mt-4">
							<button type="Button" class="btn btn-warning btn-block" id="Buscar"><i class="fas fa-search"></i></button>
						</div>
						<div class="col-10">
							<div class="form-group">
								<strong class="d-block text-center">Conteste a su Pregunta de Seguridad</strong>
								<strong><em id="PreguntaSeguridad">Busque a su usuario</em></strong>
								<input type="text" id="RespuestaPreguntaSeguridad" name="RespuestaPreguntaSeguridad" class="form-control" required minlength="4" maxlength="20">
								<strong class="d-block text-center">Ingrese su nueva Contraseña</strong>
								<input type="password" id="ContraseñaNueva" name="ContraseñaNueva" class="form-control" required minlength="4" maxlength="20">
								<strong class="d-block text-center">Repita su nueva Contraseña</strong>
								<input type="password" id="RepeticiónContraseña" name="RepeticiónContraseña" class="form-control" required minlength="4" maxlength="20">
							</div>
						</div>
						<div class="col-6">
							<button class="btn btn-info btn-block"><h5>Actualizar</h5></button>
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</div>
</div>