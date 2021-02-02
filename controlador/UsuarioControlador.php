<?php 
class UsuarioControlador{
	
	function __construct(){
		$this->responsableModelo = new ResponsableModelo();
		$this->UsuarioModelo = new UsuarioModelo();
	}

	public function index(){
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}

	public function guardarUsuario() {
		$activoUsuario= isset($_REQUEST['activoUsuario']) ? 1 : 0 ;
		if (isset($_REQUEST['nombreUsuarioAgregar'], $_REQUEST['claveUsuarioAgregar'], $_REQUEST['preguntaUsuarioAgregar'], $_REQUEST['RespuestaUsuarioAgregar'], $_REQUEST['editarUsuario'])) {
			$datos = array(	$_REQUEST['nombreUsuarioAgregar'],
							$_REQUEST['claveUsuarioAgregar'],
							1,
							$_REQUEST['preguntaUsuarioAgregar'],
							$_REQUEST['RespuestaUsuarioAgregar'],
							$_REQUEST['Cedula_Usuario']);
			if (strlen($datos[0]) > 20 || strlen($datos[0]) < 4) {
				alerta('danger', 'El nombre del usuario es muy largo o corto.');
			} else if(strlen($datos[0]) == 0 || strlen($datos[1]) == 0 || strlen($datos[4]) == 0){
				alerta('danger', 'El nombre del usuario, contraseña o respuesta no debe estar vacío.');
			}  else if(preg_match('/\s/',$datos[0])){
				alerta('danger', 'El nombre del usuario no debe contener espacios.');
			} else if(preg_match('/[\W]/',$datos[0])){
				alerta('danger', 'El nombre del usuario no debe contener caracteres especiales.');
			}else if(strlen($datos[1]) > 20 || strlen($datos[1]) < 4){
				alerta('danger', 'La contraseña es muy larga.');
			} else if(preg_match('/\s/',$datos[0])){
				alerta('danger', 'La contraseña no debe contener espacios.');
			} else if(strlen($datos[4]) > 30 || strlen($datos[4]) < 4){
				alerta('danger', 'La respuesta es muy larga o corta.');
			} else {
				try {
					if ($_REQUEST['editarUsuario'] == false) {
						$this->UsuarioModelo->insertar($datos);
					 } else if ($_REQUEST['editarUsuario'] == true) {
					 	if ($_REQUEST['nombreUsuarioAgregar'] == "Admin") {
						 	$datos[2] = 1;
						 	$datos[0] = "Admin";
					 	} else {
					 		$datos[2] = $activoUsuario;
					 	}
					 	$datos[6] = $_REQUEST['idUsuarios'];
						$this->UsuarioModelo->update($datos);
					}
					alerta('success', 'Se agregó al Usuario Correctamente.');
				} catch (PDOException $e) {
					alerta('danger', 'Ha ocurrido un error al agregar al Usuario, no se pueden repetir nombres o cédulas.');
				}
			}
		} else alerta('danger', 'Está vacío algún campo');
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}
}