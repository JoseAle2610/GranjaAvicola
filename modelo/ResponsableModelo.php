<?php 
class ResponsableModelo{
	
	function __construct(){		
		$this->pdo = new Conexion();
	}

	public function insert($datos){
		$sql = 'INSERT INTO Responsables (nombreResponsable, apellidoResponsable, activo, ci) 
					VALUES (?, ?, ?, ?)';
		return $this->pdo->insertGetId($sql, $datos);
	}

	public function select($condicion='', $datos=array('')){
		$sql = "SELECT * FROM Responsables $condicion";
		return $this->pdo->obtenerTodos($sql, $datos);
	}

	public function selectById($ci){
		$sql = 'SELECT * FROM Responsables WHERE ci = ?';
		return $this->pdo->obtener($sql, array($ci));
	}

	public function delete($ci){
		$sql = 'DELETE FROM Responsables WHERE ci = ?';
		return $this->pdo->consulta($sql, array($ci));
	}

	public function update($datos){
		$sql = 'UPDATE Responsables SET nombreResponsable = ?, apellidoResponsable = ?, activo = ?
				WHERE ci = ?';
		return $this->pdo->consulta($sql, $datos);
	}

	public function insertResponsableRecogida($idRegistro, $ci){
		$sql = 'INSERT INTO responsablesderegistro (idRegistro, ci) VALUES (?,?)';
		return $this->pdo->insertGetId($sql, array($idRegistro, $ci));
	}
}