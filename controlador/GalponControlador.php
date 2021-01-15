<?php 

class GalponControlador{

	function __construct(){
		$this->galponEnLoteModelo = new GalponEnLoteModelo();
		$this->galponModelo  = new GalponModelo();
		$this->loteModelo = new LoteModelo();
		$this->sectorModelo = new SectorModelo();
		$this->consultasModelo = new ConsultasModelo();
	}

	public function index(){
		loged();
		$group = 'GROUP BY g.nombreGalpon';
		$count = 'COUNT(s.idSector) as cantModulos';
		$where = 'WHERE gl.terminado = 0';
		$this->galpones = $this->consultasModelo->infoGalpon($group, $count, $where);
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/galpon/InicioGalpon.php' ;
		require_once 'vista/galpon/AgregarGalpon.php';
		require_once 'vista/galpon/EditarGalpon.php';
		require_once 'vista/galpon/CambiarLote.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarGalpon (){
		verDatos(array($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos']));
		if (isset($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos'])) 
		{
			try {
				
				$idGalpon = 0;
				$editarGalpon = true;
				foreach ($_REQUEST['modulos'] as $posicion => $modulo) {
					$modulo = (object)$modulo;
					if ($_REQUEST['accion'] == 'agregar') {
						if ($idGalpon == 0 ) {
							$idGalpon = $this->galponModelo->insert($_REQUEST['numeroGalpon']);
							$datosGalponEnLote = array(	$idGalpon, 1, 
														$_REQUEST['NumeroGallinas'], 
														$_REQUEST['inicioLote']		);
							$this->galponEnLoteModelo->insert($datosGalponEnLote);
							alerta('success', 'Se agregó al galpon correctamente' );
						}
						$datosModulo = array($idGalpon, $modulo->nombreSector);
						$this->sectorModelo->insert($datosModulo);

						echo "ESTAMOS AGREGANDO UN NUEVO Galpon";
					}else if($modulo->accion == 'insertar'){
						$datosModulo = array($_REQUEST['editarIdGalpon'], $modulo->nombreSector);
						$this->sectorModelo->insert($datosModulo);

						echo $_REQUEST['editarIdGalpon'];
						echo " ESTAMOS AGREGANDO UN NUEVO SECTOR A UN LOTE EXISTENTE <br>";
					}else if($modulo->accion == 'editar'){
						$activo = (array)$modulo;
						$activo = (isset($activo['activo'])) ? 1 : 0;
						$this->sectorModelo->update($modulo->nombreSector,
													$activo,
													$modulo->idSector);
						echo "ESTAMOS ACTUALIZANDO EL NOMBRE DE UN LOTE<br>";
					}
				}
				if ($_REQUEST['accionEditar'] == 'editar') {
					$datosEditarGalpon = array(0, $_REQUEST['NumeroGallinas'],
												$_REQUEST['inicioLote'],
												$_REQUEST['editarIdGalpon'],
												$_REQUEST['editarIdLote']);
					$activo = isset($_REQUEST['activo']) ? 1 : 0 ;
					$this->galponModelo->update($_REQUEST['editarIdGalpon'],
												$activo, 
												$_REQUEST['numeroGalpon']);
					$this->galponEnLoteModelo->update($datosEditarGalpon);
					alerta('success', 'Se Actualizó el galpon correctamente' );
				}
			} catch (PDOException $e) {
				alerta('danger', 'Ha ocurrido un error al insertar, el número de galpón no puede repetirse');
			}
		} else {
			alerta('danger', 'Introduzca los datos para poder agregar un Galpón');
		}
		header('location:?c=Galpon');
	}

	public function cambiarLote(){
		if (isset($_REQUEST['idLoteCL'], $_REQUEST['idGalponCL'], $_REQUEST['numeroGallinasNL'],
			$_REQUEST['inicioLoteNL'], $_REQUEST['numeroGallinasVL'], 
			$_REQUEST['inicioLoteVL'])) {
			if (date("d-m-Y", strtotime($_REQUEST['inicioLoteVL'])) > date("d-m-Y", strtotime($_REQUEST['inicioLoteNL']))) {
				alerta('danger', 'El inicio del Lote anterior no puede ser mayor al nuevo');
			} else if ($_REQUEST['numeroGallinasVL'] > 50000 || $_REQUEST['numeroGallinasVL'] < 1) {
				alerta('danger', 'El número de gallinas supera la cantidad máxima o debe ser mayor a 0');
			}else if ($_REQUEST['inicioLoteNL'] < date("Y-d-m",strtotime($_REQUEST['inicioLoteVL']."+ 90 week"))){
				$Inicio = date_create($_REQUEST['inicioLoteNL']);
				$Fin = date_create(date("Y-m-d",strtotime($_REQUEST['inicioLoteVL']."+ 90 week")));
				$intervalo = date_diff($Fin, $Inicio);
				alerta('danger', 'Faltan '.intval($intervalo->days / 7).' semanas y '.$intervalo->d.' días para acabar el lote');
				try {
					// actualizar el lote y deactivarlo
					$datos = array(	1,
									$_REQUEST['numeroGallinasVL'],
									$_REQUEST['inicioLoteVL'],
									$_REQUEST['idGalponCL'],
									$_REQUEST['idLoteCL']);
					$this->galponEnLoteModelo->update($datos);
					// agregar el nuevo
					$datos = array($_REQUEST['idLoteCL']+1,
								   $_REQUEST['idLoteCL']+1);
					$this->loteModelo->insertNotExisst($datos);
					$datos = array(	$_REQUEST['idGalponCL'],
									$_REQUEST['idLoteCL']+1,
									$_REQUEST['numeroGallinasNL'],
									$_REQUEST['inicioLoteNL']);
					$this->galponEnLoteModelo->insert($datos);
					alerta('success', 'Se cambió el Lote Correctamente');
				} catch (PDOException $e) {
					alerta('danger', 'No se pudo Sacar el Lote');
					alerta('danger', $e->getMessage());
				}
			} 
		}else{
			alerta('danger', 'Ingrese los datos para cambiar de un lote a otro');
		}
		header('location:?c=galpon');
	}
}