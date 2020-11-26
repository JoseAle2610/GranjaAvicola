











<div class="modal fade " id="AgregarMortalidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" >
	<div class="modal-dialog modal-fluid" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header bg-warning text-white">
				<p class="heading lead">Agregar Mortalidad</p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>
			<!--Body-->
			<form method="post" action="?c=ControlAves&m=AgregarMortalidad">
				<div class="modal-body">
					
					<table class="table table-responsive table-sm">
						<thead class="table-info">
							<th><input type="date" name="fecha" class="form-control form-control-sm"></th>
							<?php  
								#AGREGAR NOMBRE DEL GALPON
								$GalponesEnLote = $this->GalponEnLoteModelo->select();
								foreach ($GalponesEnLote as $key => $galpon) {
									echo "<th>G-$galpon->idGalpon Lote-$galpon->idLote</th>";
								}
							?>
						</thead>
						<tbody>	
							<tr>
								<td>Cant Gallinas</td>
								<?php foreach ($GalponesEnLote as $key => $galpon): ?>
									<td><?= $galpon->gallinas ?></td>
								<?php endforeach ?>
							</tr>
							<tr>
								<td>Mortalidad</td>
								<?php 
								foreach ($GalponesEnLote as $key => $galpon) {
									echo "	<td>
												<input type='number' name='mortalidad[$key][numeroMuertes]' class='form-control'>
												<input type='hidden' name='mortalidad[$key][idGalpon]' value='$galpon->idGalpon'>
												<input type='hidden' name='mortalidad[$key][idLote]' value='$galpon->idLote'>
											</td>";
								}
								?>
							</tr>
						</tbody>
					</table>
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