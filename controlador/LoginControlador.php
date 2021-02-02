<?php 
class LoginControlador{
	
	function __construct(){
		$this->usuarioModelo = new UsuarioModelo();
	}

	public function index(){
		require_once 'vista/includes/header.php';
		require_once 'vista/LoginVista.php';
		require_once 'vista/LoginContraseña.php';
		require_once 'vista/includes/footer.php';
	}

	public function login(){
		if (isset($_REQUEST['nombreUsuario'], $_REQUEST['claveUsuario'])) {

			$usuario = $this->usuarioModelo->verificar($_REQUEST['nombreUsuario'], $_REQUEST['claveUsuario']);
			if (!empty($usuario) && $usuario->nombreUsuario == $_REQUEST['nombreUsuario']) {
				$_SESSION['login'] = true;
				$_SESSION['nombreUsuario'] = $usuario->nombreUsuario;
				$_SESSION['claveUsuario'] = $usuario->claveUsuario;
				header('location:?c=recogida');
			}else{
				alerta('danger', 'El usuario y/o la clave con la que intenta acceder no son válidos.');
				header('location:./');
			}
		}else{
				alerta('danger', 'Ingrese los datos para poder acceder al sistema.');
			header('location:./');
		}
	}

	public function logout(){
		$_SESSION['login'] = null;
		unset($_SESSION['login']);
		session_destroy();
		header('location:./');
	}

	public function CambiarContra(){
		if (isset($_REQUEST['nombreUsuarioRecuperar'], $_REQUEST['RespuestaPreguntaSeguridad'], $_REQUEST['ContraseñaNueva'], $_REQUEST['RepeticiónContraseña'])) {
			
			if ($_REQUEST['ContraseñaNueva'] != $_REQUEST['RepeticiónContraseña']) {
				alerta('danger', 'Las contraseñas no coinciden.');
			} else {
				$usuario = $this->usuarioModelo->select("WHERE nombreUsuario = ?", array($_REQUEST['nombreUsuarioRecuperar']));
				if ($_REQUEST['RespuestaPreguntaSeguridad'] == $usuario[0]->respuesta) {
					$usuario[0]->claveUsuario = $_REQUEST['RepeticiónContraseña'];
					$usuario = array($usuario[0]->nombreUsuario,
					$usuario[0]->claveUsuario, $usuario[0]->activo,
					$usuario[0]->pregunta , $usuario[0]->respuesta, 
					$usuario[0]->ci, $usuario[0]->idUsuarios);
					$this->usuarioModelo->update($usuario);
					alerta('success', 'Al usuario '.$usuario[0].' se le actualizó su contraseña exitosamente.');
				} else alerta('danger', 'Su respuesta no coincide con la anteriormente proporcionada, intente nuevamente.');
			}
			header('location:./');
		} else{
				alerta('danger', 'Ingrese los datos para poder actualizar su información.');
		}
	}

}