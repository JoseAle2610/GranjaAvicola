<div class="container-fluid mt-3">
	<div class="row justify-content-end">
		<div class="col-8 col-md-6 col-lg-4">
			<div class="card card-dark">
				<div class="card-body">
					<h4 class="text-center text-white esconder">Iniciar Sesión</h4>
					<div class="row justify-content-center">
						<div class="col-auto mb-2  esconder">
							<img src="assets/img/Logo.png" class="rounded-circle">
						</div>
						<div class="col-12">
							<form method="post" action="?c=login&m=login" id="formLogin">
								<div class="form-group">
									<strong class="d-block text-center text-white">Usuario</strong>
									<input type="text" name="nombreUsuario" class="form-control" required minlength="4" maxlength="20">
								</div>
								<div class="form-group">
									<strong class="d-block text-center text-white">Contraseña</strong>
									<input type="password" name="claveUsuario" class="form-control" required minlength="6" maxlength="15">
								</div>
								<button class="btn btn-warning text-dark btn-block">Aceptar</button>
								<button class="col-auto btn btn-Secondary text-white" data-toggle="modal" data-target="#CambiarContra" type="button">¿Olvidó su contraseña?</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>