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

}