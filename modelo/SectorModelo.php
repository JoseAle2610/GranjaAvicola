<?php

class SectorModelo
{
	
	function __construct()
	{
		$this->pdo = new Conexion();
	}

	public function insert(array $datos){
		$sql = 'INSERT INTO Sectores (idGalpon, nombreSector) VALUES (?,?)';
		return $this->pdo->consulta($sql, $datos);
	}

	public function selectById($idSector){
		$sql = 'SELECT idSector as id, idGalpon, nombreSector as nombre 
				FROM Sectores WHERE idSector = ?';
		return $this->pdo->obtener($sql, array($idSector)  );
	}

	public function selectByName($idGalpon, $nombreSector){
		$sql = 'SELECT idSector as id, idGalpon, nombreSector as nombre 
				FROM Sectores WHERE idGalpon = ? AND nombreSector = ?';
		return $this->pdo->obtener($sql, array($idGalpon, $nombreSector)  );
	}

	public function select($condicion = '', $datos = array('') ){
		$sql = 'SELECT idSector as id, idGalpon, nombreSector as nombre
				FROM Sectores '.$condicion;
		return $this->pdo->obtenerTodos($sql, $datos );
	}

	public function update($nombreSector, $idSector){
		$sql = 'UPDATE Sectores SET nombreSector = ? WHERE idSector = ?';
		return $this->pdo->consulta($sql, array($nombreSector, $idSector));
	}

	public function delete($idSector){
		$sql = 'DELETE FROM Sectores WHERE idSector = ?';
		return $this->pso->consulta($sql, array($idSector));
	}

}