<?php

class Conexion{

	private $link          = "mysql:host=localhost;dbname=granja;charset=utf8";
	private $nombreUsuario = 'root';
	private $clave         = '123456';

	function __construct(){}

	private function conectar(){
		try {
			$pdo = new PDO($this->link, $this->nombreUsuario, $this->clave);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	private function desconectar($pdo, $gdent){
		$pdo = null;
		$gsent = null;
	}

	public function obtener($sql, $datos = array('')){
		try {
			$pdo = $this->conectar();
			$gsent = $pdo->prepare($sql);
			$gsent->execute($datos);
			$datos = $gsent->fetch(PDO::FETCH_OBJ);
			$this->desconectar($pdo, $gsent);
			return $datos;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function obtenerTodos($sql, $datos = array('')){
		try {
			$pdo = $this->conectar();
			$gsent = $pdo->prepare($sql);
			$gsent->execute($datos);
			$datos = $gsent->fetchAll(PDO::FETCH_OBJ);
			$this->desconectar($pdo, $gsent);
			return $datos;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function consulta($sql, $datos = array('')){
		$pdo = $this->conectar();
		$gsent = $pdo->prepare($sql);
		$resultado = $gsent->execute($datos);
		$this->desconectar($pdo, $gsent);
		return $resultado;
	}

	public function insertGetId($sql, $datos = array('') ){
		$pdo = $this->conectar();
		$gsent = $pdo->prepare($sql);
		$gsent->execute($datos);
		$resultado = $pdo->lastInsertId();
		$this->desconectar($pdo, $gsent);
		return $resultado;
	}
}

?>