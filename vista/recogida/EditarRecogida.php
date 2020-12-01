<div class="modal fade " id="EditarRecogida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-dark text-white">
				<div class="d-flex justify-content-between">
						<img src="assets/img/cesta.png" height="40px" class="mr-1 ">
						<h5 class="heading lead mt-0 mt-md-1">
							Editar Recogida
						</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=recogida&m=editarRecogida">
				<div class="modal-body">
					
					<div class="form-group row">
						<div class="col-6 col-md-3 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-dark text-white">Galpón</span>
								</div>
								<?=select($this->GalponModelo->select(), 'idGalponEditar')?>
							</div>
						</div>
						<div class="col-6 col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-dark text-white">Modulo</span>
								</div>
								<select class="form-control idSector" name="idSectorEditar" id="idSectorEditar" >
								</select>
							</div>
						</div>
						<div class="col-6 col-md-3 mb-2 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white">Fecha</span>
							</div>
							<input type="date" name="fechaEditar" id="FechaEditar" class="form-control" min="2000-01-01" max="2020-12-31" value="2020-10-23" required>
						</div>
						<div class="col-6 col-md-3 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white">Responsable</span>
								</div>
								<?php 
									$responsables = $this->ResponsableModelo->select();
									$select = "<select class='form-control' name='responsableEditar' id='responsableEditar'>";
									foreach ($responsables as $key => $registro) {
										$select .= "<option value='$registro->ci'>$registro->ci</option>";
									}
									$select .= '</select>';
									echo $select;
								?>
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
						<?php 
							$categorias = $this->RecogidaModelo->selectCategorias();
							$horas = array('09:00','14:00','18:00');
							for ($i=0; $i < 3 ; $i++) {
								echo "<tr>
										<td>".($i + 1)."</td>
										<td><input type='time' class='form-control' name='recogida[$i][hora]' value='$horas[$i]'></td>";
								foreach ($categorias as $key => $categoria) {
									echo "<td><input type='number' class='form-control' name='recogida[$i][$categoria->idCategoria]'></td>";
								}
								echo "</tr>";
							}
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