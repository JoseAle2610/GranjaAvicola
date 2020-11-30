<?php 
class RecogidaModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insert($idRegistro, $hora){
		$sql = 'INSERT INTO Recogidas (idRegistro, hora) VALUES (?, ?)';
		return $this->pdo->insertGetId($sql, array($idRegistro, $hora));
	}

	public function selectById($idRecogida){
		$sql = 'SELECT idRecogida, idRegistro, hora FROM Recogidas WHERE idRecogida = ?';
		return $this->pdo->obtener($sql, array($idRecogida)	);
	}

	public function select($condicion = '', $datos = array('') ){
		$sql = 'SELECT idRecogida, idRegistro, hora FROM Recogidas '.$condicion;
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function delete($idRecogida){
		$sql = 'DELETE FROM Recogidas WHERE idRecogida = ?';
		return $this->pdo->consulta($sql, array($idRecogida) );
	}

	public function update($idRecogida, $hora){
		$sql = 'UPDATE Recogidas SET hora = ? WHERE idRecogida = ?';
		return $this->pdo->consulta($sql, array( $hora, $idRecogida));
	}

	####################################################################
	# INSERTANDO VALORES A LA RECOGIDA, COMO LA CANTIDAD DE HUEVOS ETC #
	####################################################################

	public function insertValores($idRecogida, $idCategoria, $valor){
		$sql = 'INSERT INTO Valores(idRecogida, idCategoria, valor) VALUES (?, ?, ?)';
		return $this->pdo->insertGetId($sql, array($idRecogida, $idCategoria, $valor) );
	}

	public function updateValores($idRecogida, $idCategoria, $valor){
		$sql = 'UPDATE Valores SET valor = ? WHERE idRecogida = ? AND idCategoria = ?';
		return $this->pdo->consulta($sql, array($valor, $idRecogida, $idCategoria) );
	}

	public function selectCategorias(){
		$sql = 'SELECT * FROM categorias';
		return $this->pdo->obtenerTodos($sql, array(''));
	}
}