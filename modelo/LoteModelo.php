<?php 
class LoteModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($numeroLote){
		$sql = 'INSERT INTO Lotes (numeroLote) VALUES (?)';
		return $this->pdo->consulta($sql, array($numeroLote));
	}

	public function selectByName($numeroLote){
		$sql = 'SELECT idLote as id, numeroLote as nombre FROM Lotes WHERE numeroLote = ?';
		return $this->pdo->obtener($sql, array($numeroLote)	);
	}

	public function selectById($idLote){
		$sql = 'SELECT idLote as id, numeroLote as nombre FROM Lotes WHERE idLote = ?';
		return $this->pdo->obtener($sql, array($idLote)	);
	}

	public function select(){
		$sql = 'SELECT idLote as id, numeroLote as nombre FROM Lotes';
		return $this->pdo->obtenerTodos($sql, array('')	);
	}

	public function delete($id){
		$sql = 'DELETE FROM Lotes WHERE idLote = ?';
		return $this->pdo->consulta($sql, array($id) );
	}

	public function update($idLote, $numeroLote){
		$sql = 'UPDATE Lotes SET numeroLote = ? WHERE idLote = ?';
		return $this->pdo->consulta($sql, array( $numeroLote, $idLote));
	}
}