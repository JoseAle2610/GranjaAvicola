<?php 
class ResponsableModelo{
	
	function __construct(){		
		$this->pdo = new Conexion();
	}

	public function insert($datos){
		$sql = 'INSERT INTO Responsables (ci, nombreResponsable, apellidoResponsable) VALUES (?, ?, ?)';
		return $this->pdo->insertGetId($sql, $datos);
	}

	public function select(){
		$sql = 'SELECT * FROM Responsables';
		return $this->pdo->obtenerTodos($sql);
	}

	public function selectById($idResponsable){
		$sql = 'SELECT idResponsable as id, concat(nombreResponsable," ",apellidoResponsable) as nombre
				FROM Responsables WHERE idResponsable = ?';
		return $this->pdo->obtenerTodos($sql, array($idResponsable));
	}

	public function delete($idResponsable){
		$sql = 'DELETE FROM Responsables WHERE idResponsable = ?';
		return $this->pdo->consulta($sql, array($idResponsable));
	}

	public function update($datos){
		$sql = 'UPDATE Responsables SET nombreResponsable = ?, apellidoResponsable = ?
				WHERE idResponsable = ?';
		return $this->pdo->consulta($sql, $datos);
	}

}