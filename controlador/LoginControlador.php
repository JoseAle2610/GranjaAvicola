<?php 
class LoginControlador{

	private $users = array( array('nombre' => 'Admin', 'contraseña' => '123456'),
							array('nombre' => 'User', 'contraseña' => '654321')	);
	
	function __construct(){}

	public function index(){
		require_once 'vista/includes/header.php';
		require_once 'vista/LoginVista.php';
		require_once 'vista/includes/footer.php';
	}

	public function login(){
		if (isset($_REQUEST['nombreUsuario'], $_REQUEST['claveUsuario'])) {
			if(	$_REQUEST['nombreUsuario'] == 'Admin' && 
				$_REQUEST['claveUsuario'] == '123456'){

				$_SESSION['login'] = true;
				$_SESSION['nombreUsuario'] = $_REQUEST['nombreUsuario'];
				$_SESSION['claveUsuario'] = $_REQUEST['claveUsuario'];

				header('location:?c=Recogida');
			}else{
				$_SESSION['alerta'] = array( array('color'  =>  'danger', 'mensaje'  =>  "Los datos con los que intento acceder no son los correctos"));
				#error
				$this->index();
			}
		}else{
			#error
			$this->index();
		}
	}

	public function logout(){
		$_SESSION['login'] = null;
		unset($_SESSION['login']);
		session_destroy();
		header('location:./');
	}

}