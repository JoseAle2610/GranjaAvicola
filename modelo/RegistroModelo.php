<?php 
class RegistroModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($idSector, $fecha){
		$sql = 'INSERT INTO Registros (idSector, fecha) VALUES (?, ?)';
		return $this->pdo->insertGetId($sql, array($idSector, $fecha));
	}

	public function selectById($idRegistro){
		$sql = 'SELECT idRegistro, idSector, semana, fecha FROM Registros WHERE idRegistro = ?';
		return $this->pdo->obtener($sql, array($idRegistro)	);
	}

	public function select($condicion = '', $datos = array('') ){
		$sql = 'SELECT idRegistro, idSector, semana, fecha FROM Registros '.$condicion;
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function delete($idRegistro){
		$sql = 'DELETE FROM Registros WHERE idRegistro = ?';
		return $this->pdo->consulta($sql, array($idRegistro) );
	}

	public function update( $semana, $fecha, $idRegistro){
		$sql = 'UPDATE Registros SET semana = ?, fecha = ? WHERE idRegistro = ?';
		return $this->pdo->consulta($sql, array( $semana, $fecha, $idRegistro));
	}
}