<?php 
class ControlAvesControlador
{
	
	function __construct(){
		$this->GalponEnLoteModelo = new GalponEnLoteModelo();
		$this->MortalidadModelo   = new MortalidadModelo();
	}

	public function index(){
		loged();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/ControlAves/InicioControlAves.php';
		require_once 'vista/includes/footer.php';
	}

	public function AgregarMortalidad(){
		if (isset($_REQUEST['mortalidad'], $_REQUEST['fecha'])){
			// AGREGAR MORATALIDAD
			foreach ($_REQUEST['mortalidad'] as $key => $valor) {
				$valor = (object)$valor;
				$this->MortalidadModelo->insert($valor->idGalpon,
												$valor->idLote,
												$valor->numeroMuertes,
												$_REQUEST['fecha']);
			}
			alerta('success', 'Se agregó correctamnete la Mortalidad');
		}else {
			alerta('danger', 'Introduzca los datos para poder agregar Mortalidad');
		}
		header('location:?c=ControlAves');
	}
}