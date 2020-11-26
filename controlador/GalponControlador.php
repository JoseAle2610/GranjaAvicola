<?php 

class GalponControlador{
	
	function __construct(){
		$this->galponEnLoteModelo = new GalponEnLoteModelo();
		$this->galponModelo  = new GalponModelo();
		$this->loteModelo = new LoteModelo();
		$this->SectorModelo = new SectorModelo();
	}

	public function index(){
		loged();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		
		require_once (isset($_REQUEST['p'])) ? 'vista/galpon/Modulo.php' : 'vista/galpon/InicioGalpon.php' ;
		
		require_once 'vista/galpon/AgregarGalpon.php';
		require_once 'vista/galpon/AgregarGalponLote.php';
		require_once 'vista/galpon/AgregarSector.php';
		require_once 'vista/galpon/SacarLote.php';
		require_once 'vista/galpon/DetalleGalpon.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarGalpon (){
		// foreach ($_REQUEST['modulos'] as $key => $value) {
		// 	echo $value;
		// }
		// if (isset($_REQUEST['numeroGalpon'], $_REQUEST['NumeroGallinas'], 
		// 			$_REQUEST['InicioLote'], $_REQUEST['numeroModulo'] )) {
			
		// 	if (!filter_var($_REQUEST['numeroGalpon'],FILTER_VALIDATE_INT)){
		// 		alerta('danger', "El numero del galpón debe ser un numero entero");
		// 	}else if(!filter_var($_REQUEST['NumeroGallinas'],FILTER_VALIDATE_INT)) {
		// 		alerta('danger', "El numero de Gallinas deber ser un numero entero");
		// 	}else if (!filter_var($_REQUEST['numeroModulo'],FILTER_VALIDATE_INT)) {
		// 		alerta('danger', "El nombre del sector debe ser un numero entero");
		// 	}else {
		// 		alerta('success', 'El Galpón se ha agregardo correctamente');
		// 	}
		// }else{
		// 	alerta('danger', 'Introduzca los datos para poder agregar un Galpon');
		// }
		// header('location:?c=Galpon');
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