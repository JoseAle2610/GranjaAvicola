<?php 






class MortalidadModelo
{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($idGalpon, $idLote, $numeroMuertes, $fecha){
		$sql = 'INSERT INTO Mortalidad (idGalpon, idLote, numeroMuertes, fecha) VALUES (?,?,?,?)';
		return $this->pdo->consulta($sql, array($idGalpon, $idLote, $numeroMuertes, $fecha));
	}

	public function select(){
		$sql = 'SELECT idGalpon, idLote, numeroMuertes, fecha FROM Mortalidad';
		return $this->pdo->obtenerTodos($sql, array('')	);
	}

	public function delete($idGalpon, $idLote){
		$sql = 'DELETE FROM Mortalidad WHERE idGalpon = ? AND idLote = ?';
		return $this->pdo->consulta($sql, array($idGalpon, $idLote) );
	}

	public function update($fecha, $numeroMuertes, $idGalpon, $idLote){
		$sql = 'UPDATE Mortaldiad SET fecha = ?, numeroMuertes = ? 
				WHERE idGalpon = ? AND idLote = ?';
		return $this->pdo->consulta($sql, array( $fecha, $numeroMuertes, $idGalpon, $idLote ));
	}



}