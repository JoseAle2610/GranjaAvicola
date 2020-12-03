<div class="container-fluid mt-3">
	<div class="row justify-content-end">
		<div class="col-md-6 col-lg-4">
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
								<button class="col-auto btn btn-Secondary text-white" id="restaurarClave" type="button">¿Olvido su contraseña?</button>
							</form>

							<form method="post" action="" id="formRestaurarClave">
								<div class="form-group form-row">
									<div class="col-12 ">
										<strong class="d-block text-center text-white">Usuario</strong>
									</div>
									<div class="col-10">
										<input required="" type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" autocomplete="off">
									</div>
									<div class="col-2">
										<button class="btn btn-warning btn-block" id="buscarPregunta" type="button">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								<div class="form-group">
									<strong class="d-block text-center text-white">Pregunta</strong>
									<p class="text-white" id="pregunta"></p>
								</div>
								<div class="form-group">
									<strong class="d-block text-center text-white">Respuesta</strong>
									<input required="" type="text" name="respuesta" id="respuesta" class="form-control" autocomplete="off">
								</div>
								<div class="form-group">
									<strong class="d-block text-center text-white">Nueva clave</strong>
									<input required=""autocomplete="off" type="password" name="nueva" id="nuevaClave" class="form-control">
								</div>
								<div class="form-group">
									<strong class="d-block text-center text-white">Confirmar Nueva clave</strong>
									<input required="" type="password" autocomplete="off" name="nueva" id="nuevaClaveConfirm" class="form-control">
								</div>
								<button class="btn btn-warning btn-block">Confirmar</button>
								<button class="col-auto btn btn-Secondary text-white btn-block" id="cancelar" type="button">Cancelar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>