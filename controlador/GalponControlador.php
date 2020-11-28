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
		$this->galpones = $this->consultasModelo->tablaGalponInicio();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		
		require_once 'vista/galpon/InicioGalpon.php' ;
		
		require_once 'vista/galpon/AgregarGalpon.php';
		require_once 'vista/galpon/DetalleGalpon.php';
		require_once 'vista/galpon/EditarGalpon.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarGalpon (){

		if (isset($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
					$_REQUEST['inicioLote'], $_REQUEST['modulos'])) {
			$idGalpon = 0;
			$idModulos = array();
			try {
				# INSERTAMOS EL GALPON Y CAPTURAMOS SU ID
				$idGalpon = $this->galponModelo->insert($_REQUEST['numeroGalpon']);
				# AGREGAMOS EL LOTE AL GALPON
				$datosGalponEnLote = array(	$idGalpon, 1, $_REQUEST['NumeroGallinas'], $_REQUEST['inicioLote']);
				$this->galponEnLoteModelo->insert($datosGalponEnLote);
				# AGREGAR LOS MODULOS
				foreach ($_REQUEST['modulos'] as $key => $valor) {
					$datosModulo = array($idGalpon, $valor);
					$this->sectorModelo->insert($datosModulo);
				}
				# ALERTA DE QUE TODO ESTA BIEN
				alerta('success', 'El Galpón, el lote y los sectores se han agregardo correctamente');
			} catch (PDOException $e) {
				if ($idgalpon != 0) {
					$this->galponModelo->delete($idGalpon);
					$this->galponEnLoteModelo->delete($idGalpon, 1);
				}
				alerta('danger', 'Ha ocurrido un problema al insertar los datos, por favor intente nuevamente');
				alerta('danger', $e->getMessage());
			}
		} else {
			alerta('danger', 'Introduzca los datos para poder agregar un Galpón');
		}
		header('location:?c=Galpon');
	}

	public function agregarGalponLote(){
		if (isset($_REQUEST['idGalpon'],$_REQUEST['idLote'],$_REQUEST['inicio'],$_REQUEST['gallinas'])) 
		{
			if ($this->galponEnLoteModelo->selectById($_REQUEST['idGalpon'],$_REQUEST['idLote']) == false) 
			{
				$this->galponEnLoteModelo->insert(array($_REQUEST['idGalpon'],$_REQUEST['idLote'],
														$_REQUEST['gallinas'],$_REQUEST['inicio'] ));
				alerta('success', 'Se Agregó el Galpon al Lote Correctamente');
			}else{
				alerta('danger', 'No se Pudo Agregar el Galpon al Lote, porque ya esta agregado');
			}
		}else{
			alerta('danger', 'Introduzca los datos para poder agregar un Galpon al Lote');
		}
		header('location:?c=Galpon');
	}

	public function agregarSector(){
		if (isset($_REQUEST['idGalpon'], $_REQUEST['nombreSector'])) {
			if ($this->SectorModelo->selectByname($_REQUEST['idGalpon'], $_REQUEST['nombreSector']) == false) 
			{
				$this->SectorModelo->insert(array($_REQUEST['idGalpon'], $_REQUEST['nombreSector']));
				alerta('success', 'Se agregó el sector Correctamente');
			}else{
				alerta('danger', 'No se pudo agregar el sector '.$_REQUEST['nombreSector'].', porque ya existe en el Galpon');
			}
		}else{
			alerta('danger', 'Introduzca los datos para poder agregar un sector');
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