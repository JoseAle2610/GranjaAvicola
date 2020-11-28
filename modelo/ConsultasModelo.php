<?php 
/**
 * 
 */
class ConsultasModelo
{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function infoGalpon( $group = '', $count = '', $condicion = '', $datos = array('')){
		$count = empty($count) ? '': ', '.$count;
		$sql = "SELECT gl.*, s.idSector, s.nombreSector, s.activo sectorActivo, g.nombreGalpon, g.activo, l.numeroLote $count
					FROM galpones g INNER JOIN galponesenlote gl ON g.idGalpon = gl.idGalpon 
					INNER JOIN lotes l ON l.idLote = gl.idLote 
					INNER JOIN sectores s ON g.idGalpon = s.idGalpon 
					$group $condicion";
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	// public function infoGalpon($condicion = '', $datos = array('') ){
	// 	$sql = 'SELECT g.idGalpon as id , g.nombreGalpon, gl.gallinas, 
	// 			l.numeroLote, gl.inicio, s.idSector, s.nombreSector
	// 				FROM galpones g INNER JOIN galponesenlote gl ON g.idGalpon = gl.idGalpon 
	// 				INNER JOIN lotes l ON l.idLote = gl.idLote 
	// 				INNER JOIN sectores s ON g.idGalpon = s.idGalpon ';
	// 	$sql .= $condicion;
	// 	return $this->pdo->obtenerTodos($sql, $datos);
	// }
}











