<!--<button class="btn btn-warning text-dark" data-toggle="modal" data-target="#AgregarMortalidad">Agregar Mortalidad</button> -->
<!-- CONTAINER -->
<!-- CONTAINER -->
<div class="container-lg my-3">
	<div class="row">
		<div class="col-12">
			<!-- CARD START -->
			<div class="card card-dark">
				<!-- CARD HEADER / BUTTON AGREGAR -->
				<div class="card-header justify-content-between">
					<div class="row">
						<div class="col-6 d-flex">
							<h5 class="card-title mr-2">Control de Aves</h5>
							<button class="btn btn-info btn-sm text-dark circulo py-0" data-toggle="modal" data-target="#Informacion"><h6 class="p-0"><i class="fas mt-2 fa-info"></i></h6></button>
						</div>
						<div class="col-6">
							<div class="row justify-content-end">
								<h6 class="text-right d-flex mt-1 col-auto">Lote:<em id="NombreLote"></em></h6>
									<input class="col-1 mt-2" type="checkbox" name="Active" id="Active" checked disabled>Activo
							</div>
						</div>
					</div>
					
					<div class="col-auto d-inline-block">
						
						
					</div>
				</div>
				<div class="card-body">
					<form method="POST" action="?c=controlAves&m=AgregarMortalidad">
						<div class="row justify-content-between ">
							<div class="col-6 col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Galpón</span>
									</div>
<?php
	$select = "<select class='form-control' name='Nombre_Galpon' id='Nombre_Galpon'>";
	foreach ($GalponModelo->select() as $key => $registro) {
	$select .= "<option value='$registro->id'>$registro->nombre</option>";
	}
	$select .= '</select>';
	echo $select;
			
?>
								</div>
							</div>
							<div class="col-6 col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<sapn class="input-group-text">N° Gallinas</sapn>
									</div>
									<input type="number" name="NumeroGallinas" id="NumeroGallinas" class="form-control" readonly 
<?php if (isset($Galpon)): ?>
	value=<?php echo "$Galpon->gallinas";?>
<?php endif ?> >
								</div>
							</div>
							
						</div>
						<div class="row mb-1 justify-content-center">
							<div class="col-8 col-md-5">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Mortalidad</span>
									</div>
									<input type="number" class="form-control" min="1" max="90000" required id="Mortalidad" name="Mortalidad">
								</div>
							</div>
							<div class="col-8 col-md-5">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Fecha</span>
									</div>
									<input type="date" class="form-control" name="FechaMortalidad" id="FechaMortalidad" min="2000-01-01" max="<?php echo date("Y-m-d");?>" 
									value="<?php echo date("Y-m-d");?>" required>
								</div>
							</div>
							
						</div>
						<div class="row justify-content-center mb-2">
							<div class="col-5">
								<button class="btn btn-warning btn-block">Agregar</button>
							</div>
						</div>
					</form>
					<div class="row justify-content-center">
						<div class="col-3">
							<img src="assets/img/gallinaa.png" class="img-fluid">
						</div>
						<div class="col-6">
							<table class="table table-striped table-hover p-0 text-center">
								<thead class="bg-orange text-dark">
									<th>Mortalidad</th>
									<th>Fecha</th>
									<th>Gallina restantes</th>
								</thead>
								<tbody id="Hola">
<?php  
if (isset($Galpon) && $numeroMuertes != 0){
	echo "<td>$numeroMuertes</td>";
	$numeroMuertes = $Galpon->gallinas - $numeroMuertes;
	echo "<td>$Galpon->inicio</td><td>$numeroMuertes</td>";
} else{
	echo "<td colspan='3'>Vacío</td>";
}
?>
									<?php if (isset($Galpon)): ?>
										
									<?php endif ?>
									<!-- Llenado por SELECT en consultas.js -> $('#Nombre_Galpon').change(function() -->
								</tbody>
							</table>
						</div>
						<div class="col-3">
							<img src="assets/img/gallina1.png" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
			<!-- CARD END -->
		</div>
	</div>
</div>
<!-- CONTAINER END -->