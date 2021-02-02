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
		if (isset($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos'])) {
			if (!empty(Numerogallinas($_REQUEST['NumeroGallinas']))) {
				alerta('danger', Numerogallinas($_REQUEST['NumeroGallinas']));
			}else{
			try {
				$idGalpon = 0;
				$editarGalpon = true;
				if (isset($_REQUEST['editarIdGalpon'])) {
				$Galpon = $this->galponEnLoteModelo->seleccionando(array($_REQUEST['editarIdGalpon'])); 
				 if (!empty(Fechamayor($_REQUEST['inicioLote'], $Galpon->inicio))) {
					alerta('danger', Fechamayor($_REQUEST['inicioLote'], $Galpon->inicio));
				} 
				}
				foreach ($_REQUEST['modulos'] as $posicion => $modulo) {
					$modulo = (object)$modulo;
					if (isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'agregar') {
						if ($idGalpon == 0 ) {
							$idGalpon = $this->galponModelo->insert($_REQUEST['numeroGalpon']);
							$datosGalponEnLote = array(	$idGalpon, 1, 
														$_REQUEST['NumeroGallinas'], 
														$_REQUEST['inicioLote']		);
							$this->galponEnLoteModelo->insert($datosGalponEnLote);
							alerta('success', 'Se agregó al Galpón correctamente.' );
						}
						$datosModulo = array($idGalpon, $modulo->nombreSector);
						$this->sectorModelo->insert($datosModulo);
					}else if($modulo->accion == 'insertar'){
						$datosModulo = array($_REQUEST['editarIdGalpon'], $modulo->nombreSector);
						$this->sectorModelo->insert($datosModulo);
					}else if($modulo->accion == 'editar' && empty(Fechamayor($_REQUEST['inicioLote'], $Galpon->inicio))){ 
						$activo = (array)$modulo;
						$activo = (isset($activo['activo'])) ? 1 : 0;
						$this->sectorModelo->update($modulo->nombreSector,
													$activo,
													$modulo->idSector);
					}
				}
				if (isset($_REQUEST['editarIdGalpon'], $_REQUEST['accionEditar'])) {
				if ($_REQUEST['accionEditar'] == 'editar' && empty(Fechamayor($_REQUEST['inicioLote'], $Galpon->inicio))) {
					$datosEditarGalpon = array(0, $_REQUEST['NumeroGallinas'],
												$_REQUEST['inicioLote'],
												$_REQUEST['editarIdGalpon'],
												$_REQUEST['editarIdLote']);
					$activo = isset($_REQUEST['activo']) ? 1 : 0 ;
					$this->galponModelo->update($_REQUEST['editarIdGalpon'],
												$activo, 
												$_REQUEST['numeroGalpon']);
					$this->galponEnLoteModelo->update($datosEditarGalpon);
					alerta('success', 'Se Actualizó el Galpón correctamente.');
				}}
			} catch (PDOException $e) {
				alerta('danger', 'Ha ocurrido un error al insertar. Recuerde que el número de Galpón no puede repetirse.');
			}
			}	
		} else {
			alerta('danger', 'Introduzca los datos para poder agregar un Galpón.');
		}
		header('location:?c=Galpon');
	}

	public function cambiarLote(){
		if (isset($_REQUEST['idLoteCL'], $_REQUEST['idGalponCL'], $_REQUEST['numeroGallinasNL'],
			$_REQUEST['inicioLoteNL'], $_REQUEST['numeroGallinasVL'], 
			$_REQUEST['inicioLoteVL'])) {

			if (!empty(Fechamayor($_REQUEST['inicioLoteNL'], $_REQUEST['inicioLoteVL']))) {
				alerta('danger', Fechamayor($_REQUEST['inicioLoteNL'], $_REQUEST['inicioLoteVL']));
			} else if (!empty(Numerogallinas($_REQUEST['numeroGallinasNL']))) {
				alerta('danger', Numerogallinas($_REQUEST['numeroGallinasNL']));
			}else{
				// Solo si el nuevo lote es cambiado antes de llegar a las 90 semanas
			 	if ($_REQUEST['inicioLoteNL'] < date("Y-d-m",strtotime($_REQUEST['inicioLoteVL']."+ 90 week"))){
				 	$Inicio = date_create($_REQUEST['inicioLoteNL']);
					$Fin = date_create(date("Y-m-d",strtotime($_REQUEST['inicioLoteVL']."+ 90 week")));
					$intervalo = date_diff($Fin, $Inicio);
					alerta('warning', 'Faltan '.intval($intervalo->days / 7).' semanas y '.$intervalo->d.' días para acabar el lote.');
				}
				try {
					// actualizar el lote y desactivarlo
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
					alerta('success', 'Se cambió el Lote Correctamente.');
				} catch (PDOException $e) {
					alerta('danger', 'No se pudo Sacar el Lote.');
				}
			} 
		}else{
			alerta('danger', 'Ingrese los datos para cambiar de un lote a otro.');
		}
		header('location:?c=galpon');
	}
}