<div class="modal fade " id="AgregarRecogida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<div class="d-flex justify-content-between">
						<img src="assets/img/cesta.png" height="40px" class="mr-1 ">
						<h5 class="heading lead mt-0 mt-md-1">
							Agregar Recogida
						</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=recogida&m=agregarRegistro">
				<div class="modal-body">
					
					<div class="form-group row">
						<div class="col-6 col-md-3 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-dark text-white">Galpón</span>
								</div>
								<select class="form-control" name="idGalpon">
									<option value="1">G-1</option>
									<option value="2">G-2</option>
									<option value="3">G-3</option>
									<option value="4">G-4</option>
									<option value="5">G-5</option>
									<option value="6">G-6</option>
									<option value="7">G-7</option>
									<option value="8">G-8</option>
								</select>
							</div>
						</div>
						<div class="col-6 col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-dark text-white">Modulo</span>
								</div>
								<select class="form-control" name="idSector">
									<option value="1">M-1</option>
									<option value="2">M-2</option>
									<option value="3">M-3</option>
								</select>
								
							</div>
						</div>
						<div class="col-6 col-md-3 mb-2">
							<input type="date" name="fecha" id="Fecha" class="form-control" min="2000-01-01" max="2020-12-31" value="2020-10-23" required>
						</div>
						<div class="col-6 col-md-3 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white">Semana</span>
								</div>
								<input type="number" name="semana" id="Semana" class="form-control" min="1" max="90" required>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-between">
						<h5 class="col-1">Recogidas</h5>
						<hr class="col-10 bg-info">
					</div>
					<table class="table table-sm table-responsive">
						<thead class="table-info text-center">
							<th class="numeral">#</th>
							<th>Hora</th>
							<th>Grandes</th>
							<th>Medianos</th>
							<th>Pequeños</th>
							<th>Picados</th>
							<th>Debil</th>
							<th>Derramados</th>
							<th>Rusticos</th>
							<th>Pool</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td><input type="time" class="form-control" value="09:00" min="09:00" max="11:59" required></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
							</tr>
							<tr>
								<td>2</td>
								<td><input type="time" class="form-control" value="14:00" min="12:00" max="15:59" required></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
							</tr>
							<tr>
								<td>3</td>
								<td><input type="time" class="form-control" value="18:00" min="16:00" max="18:00" required></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
								<td><input type="number" name="" class="form-control"></td>
							</tr>
						<?php 
							// $categorias = $this->RecogidaModelo->selectCategorias();
							// $horas = array('09:00','14:00','18:00');
							// for ($i=0; $i < 3 ; $i++) {
							// 	echo "<tr>
							// 			<td>".($i + 1)."</td>
							// 			<td><input type='time' class='form-control' name='recogida[$i][hora]' value='$horas[$i]'></td>";
							// 	foreach ($categorias as $key => $categoria) {
							// 		echo "<td><input type='number' class='form-control' name='recogida[$i][$categoria->idCategoria]'></td>";
							// 	}
							// 	echo "</tr>";
							// }
						 ?>
						</tbody>
					</table>
					
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="submit" class="btn btn-info"><h5><i class="fas fa-save"></i></h5></button>
					<a role="button" class="btn btn-danger text-white" data-dismiss="modal"><h5><i class="fas fa-ban"></h5></i></a>
				</div>
			</form>
		</div>
		<!--/.Content-->
	</div>
</div>