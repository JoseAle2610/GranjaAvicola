<?php 
/**
 * 
 */
class ReportesControlador
{
	
	function __construct(){
		$this->galponModelo = new GalponModelo();
	}

	public function index(){
		$pagina = !isset($_REQUEST['p']) ? 'CierreMes':$_REQUEST['p']; 
		loged();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/reportes/'.$pagina.'.php';
		require_once 'vista/includes/footer.php';
	}

}