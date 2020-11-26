<?php 
class ResponsablesDeRegistroModelo{
	
	function __construct(){		
		$this->pdo = new Conexion();
	}

	public function insert($datos){
		$sql = 'INSERT INTO ResponsablesDeRegistro (idRegistro, idResponsable) VALUES (?, ?)';
		return $this->pdo->consulta($sql, $datos);
	}

	public function select($condicion = '', $datos = array('')){
		$sql = 'SELECT idRegistro, idResponsable FROM Responsables'.$condicion;
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function delete($idRegistro, $idResponsable){
		$sql = 'DELETE FROM ResponsablesDeRegistro WHERE idRegistro = ? AND idResponsable = ?';
		return $this->pdo->consulta($sql, array($idRegistro, $idResponsable));
	}

	public function update($datos){
		$sql = 'UPDATE ResponsablesDeRegistro SET idResponsable = ?
				WHERE idResponsable = ? AND idRegistro = ?';
		return $this->pdo->consulta($sql, $datos);
	}
}