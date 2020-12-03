<?php 
class LoginControlador{

	private $users = array( array('nombre' => 'Admin', 'contraseña' => '123456'),
							array('nombre' => 'User', 'contraseña' => '654321')	);
	
	function __construct(){
		$this->usuarioModelo = new UsuarioModelo();
	}

	public function index(){
		require_once 'vista/includes/header.php';
		require_once 'vista/LoginVista.php';
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
				alerta('danger', 'El usuario y/o la clave con la que intenta acceder no son validos');
				header('location:./');
			}
		}else{
				alerta('danger', 'Ingrese los datos para poder acceder al sistema');
			header('location:./');
		}
	}

	public function logout(){
		$_SESSION['login'] = null;
		unset($_SESSION['login']);
		session_destroy();
		header('location:./');
	}

}