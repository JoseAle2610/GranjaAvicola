<?php 






class MortalidadModelo
{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($datos){
		$sql = 'INSERT INTO Mortalidad (idGalpon, idLote, numeroMuertes, fecha) VALUES (?,?,?,?)';
		return $this->pdo->insertGetId($sql, $datos);
	}

	public function select($condicion='', $datos = array('')){
		$sql = "SELECT idGalpon, idLote, numeroMuertes, fecha FROM Mortalidad $condicion";
		return $this->pdo->obtenerTodos($sql, $datos);
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