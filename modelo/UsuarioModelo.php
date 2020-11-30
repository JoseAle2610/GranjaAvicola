<?php
class UsuarioModelo{
	
	function __construct(){
		$this->pdo = new Conexion();
	}

	public function insertar(array $datos){
		$sql = 'INSERT INTO `usuarios` (nombreUsuario, claveUsuario, fechaCreacion, activo, pregunta, respuesta, ci)
		 						VALUES (?, ?, CURRENT_DATE(), ?, ?, ?, ?);';
		return $this->pdo->insertGetId($sql, $datos);
	}

	public function verificar($nombreUsuario, $claveUsuario){
		$sql = 'SELECT * FROM Usuarios WHERE (nombreUsuario = ? AND claveUsuario = ?) AND activo = 1';
		return $this->pdo->obtener($sql, array($nombreUsuario, $claveUsuario)	);
	}


}