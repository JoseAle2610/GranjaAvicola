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
		if (isset($_REQUEST['Mortalidad'], $_REQUEST['FechaMortalidad'], $_REQUEST['Nombre_Galpon'], $_REQUEST['NumeroGallinas'])){
			// AGREGAR MORATALIDAD 	
			$Hola = $this->GalponEnLoteModelo->seleccionando(array($_REQUEST['Nombre_Galpon']));

			if ($_REQUEST['Mortalidad'] > $Hola->gallinas) {
				alerta('danger', 'Esto no puede pasar');
			} else{
				try{
				$datosMortalidadModelo = array(	$_REQUEST['Nombre_Galpon'], $Hola->idLote, $_REQUEST['NumeroGallinas'], $_REQUEST['FechaMortalidad']);
				$this->MortalidadModelo->insert($datosMortalidadModelo);
				alerta('success', "Ha sido insertado satisfactoriamente");
				}catch (PDOException $e) {
							alerta('danger', 'Ha ocurrido un error al agregar mortalidad');
							alerta('danger', $e->getMessage());
				}
			}
		}else {
			alerta('danger', 'Introduzca los datos para poder agregar Mortalidad');
		}
		header('location:?c=ControlAves');
	}
}