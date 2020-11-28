<?php 
/**
 * 
 */
class ConsultasModelo
{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function tablaGalponInicio(){
		$sql = "SELECT g.idGalpon as id ,CONCAT('G-',g.nombreGalpon) nombreGalpon, gl.gallinas, 
				l.numeroLote, gl.inicio, COUNT(s.idSector) as cantModulos 
					FROM galpones g INNER JOIN galponesenlote gl ON g.idGalpon = gl.idGalpon 
					INNER JOIN lotes l ON l.idLote = gl.idLote 
					INNER JOIN sectores s ON g.idGalpon = s.idGalpon GROUP BY g.nombreGalpon";
		return $this->pdo->obtenerTodos($sql);
	}

	public function infoGalpon($condicion = '', $datos = array('') ){
		$sql = 'SELECT g.idGalpon as id , g.nombreGalpon, gl.gallinas, 
				l.numeroLote, gl.inicio, s.idSector, s.nombreSector
					FROM galpones g INNER JOIN galponesenlote gl ON g.idGalpon = gl.idGalpon 
					INNER JOIN lotes l ON l.idLote = gl.idLote 
					INNER JOIN sectores s ON g.idGalpon = s.idGalpon ';
		$sql .= $condicion;
		return $this->pdo->obtenerTodos($sql, $datos);
	}
}











