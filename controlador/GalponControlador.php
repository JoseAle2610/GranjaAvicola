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
		$this->galpones = $this->consultasModelo->infoGalpon($group, $count);
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/galpon/InicioGalpon.php' ;
		require_once 'vista/galpon/AgregarGalpon.php';
		require_once 'vista/galpon/EditarGalpon.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarGalpon (){
		verDatos(array($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos']));
		if (isset($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos'])) {
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

	public function sacarLote(){
		
		if (isset($_REQUEST['idLote'], $_REQUEST['idGalpon'])) 
		{
			$galpon = $this->galponEnLoteModelo->selectById($_REQUEST['idGalpon'], $_REQUEST['idLote']);
			if ($galpon != false) {
				$datos = array( 1, $galpon->gallinas, $galpon->idGalpon, $galpon->idLote);
				$this->galponEnLoteModelo->update($datos);
				alerta('success', 'Se sacó al Galpon del Lote Correctamente');
			}else {
				alerta('danger', 'No se pudo Sacar el Lote');
			}
		}else{
			alerta('danger', 'Ingrese los datos para Poder Sacar un Galpon de un Lote');
		}
		header('location:?c=galpon');
	}
}