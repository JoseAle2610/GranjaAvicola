<?php 
class GalponModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($nombreGalpon){
		$sql = 'INSERT INTO Galpones (nombreGalpon) Values(?)';
		return $this->pdo->consulta($sql, array(	$nombreGalpon));
	}

	public function selectByName($nombreGalpon){
		$sql = 'SELECT idGalpon as id, nombreGalpon as nombre FROM Galpones WHERE nombreGalpon = ?';
		return $this->pdo->obtener($sql, array($nombreGalpon)	);
	}

	public function selectById($idGalpon){
		$sql = 'SELECT idGalpon as id, nombreGalpon as nombre FROM Galpones WHERE idGalpon = ?';
		return $this->pdo->obtener($sql, array($idGalpon)	);
	}

	public function select(){
		$sql = 'SELECT idGalpon as id, nombreGalpon as nombre FROM Galpones';
		return $this->pdo->obtenerTodos($sql, array('')	);
	}

	public function delete($id){
		$sql = 'DELETE FROM galpones WHERE idGalpon = ?';
		return $this->pdo->consulta($sql, array($id) );
	}

	public function update($idGalpon, $nombreGalpon){
		$sql = 'UPDATE Galpones SET nombreGalpon = ? WHERE idGalpon = ?';
		return $this->pdo->consulta($sql, array( $nombreGalpon, $idGalpon));
	}
}