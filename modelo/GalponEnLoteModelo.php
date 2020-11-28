<?php 
class GalponEnLoteModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($datos){
		$sql = 'INSERT INTO GalponesEnLote (idGalpon, idLote, gallinas, inicio) VALUES (?,?,?,?)';
		return $this->pdo->insertGetId($sql, $datos);
	}

	public function selectById($idLote, $idGalpon){
		$sql = 'SELECT idGalpon, idLote, inicio, gallinas, terminado 
				FROM GalponesEnLote WHERE idGalpon = ? AND idLote = ? AND  terminado = 0';
		return $this->pdo->obtener($sql, array($idLote, $idGalpon)	);
	}

	public function select(){
		$sql = 'SELECT idGalpon, idLote, inicio, gallinas, terminado 
				FROM GalponesEnLote';
		return $this->pdo->obtenerTodos($sql, array('')	);
	}

	public function delete($idGalpon, $idLote){
		$sql = 'DELETE FROM GalponesEnLote WHERE idGalpon = ? AND idLote = ?';
		return $this->pdo->consulta($sql, array($idGalpon, $idLote) );
	}

	public function update($datos){
		$sql = 'UPDATE GalponesEnLote SET terminado = ?, gallinas = ? WHERE idGalpon = ? AND idLote = ?';
		return $this->pdo->consulta($sql, $datos);
	}
}