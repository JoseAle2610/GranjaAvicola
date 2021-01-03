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
	public function infoUsuario(){
		if (isset($_REQUEST['idUsuarios'])) {
			$UsuarioModelo = new UsuarioModelo();
			
			$UsuarioModelo = $UsuarioModelo->select("where idUsuarios = ?", array($_REQUEST['idUsuarios']));
			$UsuarioModelo = json_encode($UsuarioModelo);
			echo $UsuarioModelo;
		}
	}
	public function infoNombreGalponLote(){
		if (isset($_REQUEST['Nombre_Galpon'])) {
			$GalponEnLoteModelo = new GalponEnLoteModelo();
			$GalponEnLoteModelo = $GalponEnLoteModelo->select("where idGalpon = ?", array($_REQUEST['Nombre_Galpon']));
			$GalponEnLoteModelo = json_encode($GalponEnLoteModelo);
			echo $GalponEnLoteModelo;
		}
	}
	
	public function tabla(){
		if (isset($_REQUEST['Nombre_Galpon'])) {
			$GalponEnLoteModelo = new GalponEnLoteModelo();
			$GalponEnLoteModelo = $GalponEnLoteModelo->seleccionando(array($_REQUEST['Nombre_Galpon']));
			$MortalidadModelo = new MortalidadModelo();
			$MortalidadModelo = $MortalidadModelo->select("where idGalpon = ? AND idLote = ? ORDER BY fecha DESC", array($_REQUEST['Nombre_Galpon'], $GalponEnLoteModelo->idLote));
			$MortalidadModelo = json_encode($MortalidadModelo);
			echo $MortalidadModelo;
		} else{
			alerta('danger', "No existen");
			echo "Estamos en No existen";
		} 
	}

	public function produccionDiaria(){
		if (isset($_REQUEST['fecha'])) {
			$consultasModelo = new ConsultasModelo();
			$group = 'GROUP BY r.idSector, c.idCategoria';
			$produccionDiaria = $consultasModelo->produccionDiaria($_REQUEST['fecha'], $group, false);
			$produccionDiaria = json_encode($produccionDiaria);
			echo $produccionDiaria;
		}
	}
}