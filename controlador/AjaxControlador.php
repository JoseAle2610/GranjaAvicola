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
			$condicion = 'WHERE g.idGalpon = ? AND gl.terminado = 0';
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
			$GalponEnLoteModelo = $GalponEnLoteModelo->select("where idGalpon = ? AND terminado=0", array($_REQUEST['Nombre_Galpon']));
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
		$consultasModelo = new ConsultasModelo();
		if (isset($_REQUEST['fecha'])) {
			$where = 'WHERE r.fecha = ?';
			$group = 'GROUP BY r.idSector, c.idCategoria';
			$consultasModelo = $consultasModelo->produccionDiaria($where, $group, array($_REQUEST['fecha']));
		} else if(isset($_REQUEST['fechaDesde'], $_REQUEST['fechaHasta'])) {
			$where = 'WHERE r.fecha >= ? AND r.fecha <= ?';
			$group = 'GROUP BY r.idRegistro, c.idCategoria';
			$consultasModelo = $consultasModelo->produccionDiaria($where, $group, array($_REQUEST['fechaDesde'],
																						$_REQUEST['fechaHasta']));
		}
		$consultasModelo = json_encode($consultasModelo);
		echo $consultasModelo;
	}
	
	public function galponLotes(){
		if (isset($_REQUEST['idGalpon'])) {
			$galponEnLoteModelo = new GalponEnLoteModelo();
			$where = 'WHERE idGalpon = ?';
			$galponEnLoteModelo = $galponEnLoteModelo->select($where, array($_REQUEST['idGalpon']));
			$galponEnLoteModelo = json_encode($galponEnLoteModelo);
			echo $galponEnLoteModelo;
		}
	}

	public function formatoDistribucion(){
		if (isset($_REQUEST['idGalpon'], $_REQUEST['idLote'])) {
			$consultasModelo = new ConsultasModelo();
			$where = 'WHERE gl.idGalpon = ? AND gl.idLote = ?';
			$consultasModelo = $consultasModelo->formatoDistribucion($where, '', 
																array(	$_REQUEST['idGalpon'], 
																		$_REQUEST['idLote']));
			$consultasModelo = json_encode($consultasModelo);
			echo $consultasModelo;
		}
	}
}