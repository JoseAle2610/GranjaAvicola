<?php 

class Ajax1Controlador{
	
	function __construct(){}

	public function infoRecogida(){
		if (isset($_REQUEST['idRegistro'])) {
			$ConsultasModelo = new ConsultasModelo();
			$idRegistro = $_REQUEST['idRegistro'];
			$ConsultasModelo = $ConsultasModelo->infoRecogida("WHERE r.idRegistro = $idRegistro");
			$ConsultasModelo = $ConsultasModelo[0];
			$ConsultasModelo = json_encode($ConsultasModelo);
			echo $ConsultasModelo;
		}
	}

	public function recuperarClave(){
		if (isset($_REQUEST['nombreUsuario'])) {
			$UsuarioModelo = new UsuarioModelo();
			$nombreUsuario = $_REQUEST['nombreUsuario'];
			$UsuarioModelo = $UsuarioModelo->select("WHERE nombreUsuario = '$nombreUsuario'");
			$UsuarioModelo = $UsuarioModelo[0];
			$UsuarioModelo = json_encode($UsuarioModelo);
			echo $UsuarioModelo;
		}
	}

}