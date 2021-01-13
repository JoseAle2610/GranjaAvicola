		<div class="modal fade " id="Salir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<!--Content-->
				<div class="modal-content">
					<!--Header-->
					<div class="modal-header bg-danger text-white">
						<h5>¿Seguro que quire salir?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
						</button>
					</div>
					<!--Footer-->
					<div class="modal-footer d-flex justify-content-end">
						<a href="?c=login&m=logout" class="btn btn-danger">SI</a>
						<a role="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancelar</a>
					</div>
				</div>
				<!--/.Content-->
			</div>
		</div>
		<!-- ALERT BOX -->
		<div class="alertBox d-flex flex-column-reverse">
		<?php 

		if (isset($_SESSION['alerta'])) {
			foreach ($_SESSION['alerta'] as $key => $alerta) {
				$alerta = (object)$alerta;
				?>
				<div class="alert alert-<?= $alerta->color ?>" id="alerta">
					<?= $alerta->mensaje ?>
					<button type="button" class="close ml-2" data-dismiss="alert" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php  
			}
			unset($_SESSION['alerta']);
		}

		?>
		</div>

		<?php 
			if (isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] == 'Admin') {
				require_once 'vista/responsable.php'; 
				require_once "vista/usuario.php";
			}
		?>
		<!-- jQuery -->
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="assets/js/popper.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!-- DataTable core JavaScript -->
		<script type="text/javascript" src="assets/js/Datatable.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
		<!-- JSPDF core JavaScript -->
		<script type="text/javascript" src="assets/js/jspdf.min.js"></script>
		<!-- My core JavaScript -->
		<script type="text/javascript" src="ajax/Datatable.js"></script>
		<script type="text/javascript" src="ajax/consultas.js"></script>
		<script type="text/javascript" src="ajax/recogida.js"></script>
		<script type="text/javascript" src="ajax/login.js"></script>

	</body>
</html>