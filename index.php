<?php 
require_once 'helper.php';
require_once 'controlador/Validaciones.php';
session_start();
$controlador = 'Login';
$metodo      = 'index';

if (!isset($_REQUEST['c'])) {
	// if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
	// 	header('location:?c=recogida');
	// }
	$controlador = ucwords($controlador)."Controlador";
	$controlador = new $controlador();
	$controlador->index();
}else {
	// loged();
		$controlador = ucwords($_REQUEST['c'])."Controlador";
		// if (!file_exists("controlador/$controlador.controlador.php")) {
		// 	alerta('danger', ' el archivo que busca no esta disponible ');
		// 	# HAY QUE REDIRECCIONAR HACIA LA PAG 404
		// 	header('location:?c=Login');
		// 	die();
		// }
		$controlador = new $controlador();

		if(isset($_REQUEST['m'])){
			$metodo  = $_REQUEST['m'];
		}
		call_user_func(array($controlador, $metodo));
}
		