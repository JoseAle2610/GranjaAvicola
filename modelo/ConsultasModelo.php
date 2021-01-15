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

	public function tablaRecogidas($condicion = '', $group = '', $datos = array('')){
		$sql = "SELECT l.numeroLote, g.nombreGalpon, g.idGalpon, s.idSector, s.nombreSector, r.idRegistro, 
					r.fecha, rs.ci, rs.activo responsableActivo
					FROM lotes l 
					INNER JOIN galponesenlote gl ON l.idLote = gl.idLote
				    INNER JOIN galpones g ON g.idGalpon = gl.idGalpon
				    INNER JOIN sectores s ON s.idGalpon = g.idGalpon
				    INNER JOIN registros r ON r.idSector = s.idSector
				    INNER JOIN responsablesderegistro rr ON rr.idRegistro = r.idRegistro
				    INNER JOIN responsables rs ON rr.ci = rs.ci
				    $condicion $group";
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function recogidaValores ($condicion = ''){
		$sql = "SELECT r.*, v.valor, v.idCategoria
					FROM recogidas r INNER JOIN valores v ON r.idRecogida = v.idRecogida $condicion";
		return $this->pdo->obtenerTodos($sql);
	}

	public function infoRecogida ($condicion = ''){
		$group = 'GROUP BY r.idRegistro ';
		$recogidas = $this->tablaRecogidas($condicion, $group);
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

	public function produccionDiaria($fecha, $group){
		$sum = $group == '' ? 'v.valor': 'SUM(v.valor) valor';
		$sql = "SELECT r.fecha, r.idRegistro, r.idSector, rg.idRecogida, $sum, 
					c.idCategoria, c.NombreCategoria
					FROM registros r 
					INNER JOIN recogidas rg ON rg.idRegistro = r.idRegistro
					INNER JOIN valores v ON v.idRecogida = rg.idRecogida
					INNER JOIN categorias c ON c.idCategoria = v.idCategoria
					WHERE r.fecha = ? $group";
		return $this->pdo->obtenerTodos($sql, array($fecha));
	}

	public function formatoDistribucion($condicion = '', $group = '', $datos = array('')){
		$sql = "SELECT gl.*, s.nombreSector, r.*, v.*, c.NombreCategoria 
					FROM galponesenlote gl 
					INNER JOIN  sectores s ON s.idGalpon = gl.idGalpon
				    INNER JOIN registros r ON r.idSector = s.idSector
				    INNER JOIN recogidas rg ON rg.idRegistro = r.idRegistro
				    INNER JOIN valores v ON v.idRecogida = rg.idRecogida
				    INNER JOIN categorias c ON c.idCategoria = v.idCategoria
				    $condicion $group";
		return $this->pdo->obtenerTodos($sql, $datos);
	}
}











