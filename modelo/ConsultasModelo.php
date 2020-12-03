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
					$condicion $group ";
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function datosRecogida(){

	}

	public function tablaRecogidas($condicion = ''){
		$sql = "SELECT l.numeroLote, g.nombreGalpon, g.idGalpon, s.idSector, s.nombreSector, r.idRegistro, r.fecha, rr.ci
					FROM lotes l 
					INNER JOIN galponesenlote gl ON l.idLote = gl.idLote
				    INNER JOIN galpones g ON g.idGalpon = gl.idGalpon
				    INNER JOIN sectores s ON s.idGalpon = g.idGalpon
				    INNER JOIN registros r ON r.idSector = s.idSector
				    INNER JOIN responsablesderegistro rr ON rr.idRegistro = r.idRegistro
				    $condicion GROUP BY r.idRegistro ";
		return $this->pdo->obtenerTodos($sql);
	}

	public function recogidaValores ($condicion = ''){
		$sql = "SELECT r.*, v.valor, v.idCategoria
					FROM recogidas r INNER JOIN valores v ON r.idRecogida = v.idRecogida $condicion";
		return $this->pdo->obtenerTodos($sql);
	}

	public function infoRecogida ($condicion = ''){
		$recogidas = $this->tablaRecogidas($condicion);
		$valores = $this->recogidaValores($condicion);
		$valores1 = array();
		$recogidas1 = array();
		foreach ($valores as $key => $valor) {
			if (!isset($valores1[$valor->idRegistro])) {
				$valores1[$valor->idRegistro] = array(); 
			}	
			$valores1[$valor->idRegistro][$valor->idRecogida][$valor->idCategoria] = $valor->valor;
		}
		foreach ($recogidas as $key => $recogida) {
			if (isset($valores1[$recogida->idRegistro])) {
			 	$recogida->valores = $valores1[$recogida->idRegistro];
			}
		}
		return $recogidas;
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











