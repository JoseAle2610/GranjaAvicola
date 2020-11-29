<?php 

class AjaxControlador{
	
	function __construct(){}

	public function sectorAnidado(){
		if (isset($_REQUEST['idGalpon'])) {
			$SectorModelo = new SectorModelo();
			$condicion = 'WHERE idGalpon = ?';
			$datos = array ($_REQUEST['idGalpon']);
			$SectorModelo = $SectorModelo->select($condicion, $datos );
			$SectorModelo = json_encode($SectorModelo);
			echo $SectorModelo;
		}
	}

	public function infoGalpon(){
		if (isset($_REQUEST['idGalpon'])) {
			$consultasModelo = new ConsultasModelo();
			$condicion = 'WHERE g.idGalpon = ?';
			$datos = array ($_REQUEST['idGalpon']);
			$consultasModelo = $consultasModelo->infoGalpon('', '', $condicion, $datos);
			$consultasModelo = json_encode($consultasModelo);
			echo $consultasModelo;
		}
	}

	public function infoResponsable(){
		if (isset($_REQUEST['ci'])) {
			$responsableModelo = new ResponsableModelo();
			$responsableModelo = $responsableModelo->selectById($_REQUEST['ci']);
			$responsableModelo = json_encode($responsableModelo);
			echo $responsableModelo;
		}
	}
}