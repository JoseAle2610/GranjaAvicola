<?php 
# AUTILOAD
function autoload($clase){
	if (file_exists("controlador/$clase.php")) {
		require_once "controlador/$clase.php";
	}else{
		require_once "modelo/$clase.php";
	}
}
spl_autoload_register('autoload');
#

function select(array $datos, $name, $value=''){
	$select = "<select class='form-control $name' name='$name' id='$name'>";
	foreach ($datos as $key => $registro) {
		$selected = ($registro->id == $value) ? 'selected': '' ;
		$select .= "<option value='$registro->id' $selected>$registro->nombre</option>";
	}
	$select .= '</select>';
	echo $select;
}

function verDatos($algo){
	echo "<pre>";
	var_dump($algo);
	echo "</pre>";
}

function alerta($color, $mensaje){
	$atributos = array(	'color'   => $color,
						'mensaje' => $mensaje  );
	if (!isset($_SESSION['alerta'])) {
		$_SESSION['alerta'] = array($atributos);
	}else{
		array_push($_SESSION['alerta'], $atributos);
	}
}

function loged(){
	if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
		alerta('danger', 'Para Acceder al sistema <strong>Debes</strong> Iniciar Sesion');
		header('location:./');
		die();
	}
}

// function table($datos, $cabeza){

// }