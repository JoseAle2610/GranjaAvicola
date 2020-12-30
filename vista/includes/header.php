<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= !isset($_REQUEST['c']) ? 'Iniciar Sesion' : $_REQUEST['c'] ?></title>
		<link rel="stylesheet" href="assets/css/css/all.min.css">
		
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<!-- Datatable css -->
		<link rel="stylesheet" href="assets/css/Datatable.min.css">
		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> -->
		<!-- MY CSS -->
		<link rel="stylesheet" href="assets/css/main.css">
	</head>
	<?php $nombre = (!isset($_REQUEST['c']) || ucwords($_REQUEST['c']) == 'Login') ? 'Login' : ucwords($_REQUEST['c']) ?>
	<body>
		<div class="f fondo<?php echo ( $nombre == 'Login') ? $nombre : '' ?>"></div>

		<div class="modal fade " id="Alerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" style="z-index: 10000">
	<div class="modal-dialog" role="document">
		<!--Content-->
		<div class="modal-content">
			<div class="modal-footer d-flex justify-content-end">
				<div class="row justify-content-center text-center">
							<div class="col-auto">
								<i class="fas fa-exclamation-triangle fa-4x text-warning" style="position: relative; top: .3em; text-shadow: 1px 3px 1px #000"></i>
							</div>
							<div class="col-6">
								<h4 class="modal-title text-danger" style="text-shadow: 1px 1px 1px #000" id="">Función no diponible intente más tarde</h4>
							</div>
							<div class="col-auto">
								<i class="fas fa-exclamation-triangle fa-4x text-warning" style="position: relative; top: .3em; text-shadow: 1px 3px 1px #000"></i>
							</div>
							<div class="col-5 mt-4">
								<button class="btn btn-danger btn-block" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>
			
		