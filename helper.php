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

function select(array $datos, $name, $prefijo = '', $value=''){
	$select = "<select class='form-control $name' name='$name' id='$name'>";
	$select .= "<option value='0'>-Seleccione-</option>";
	foreach ($datos as $key => $registro) {
		$selected = ($registro->id == $value) ? 'selected': '' ;
		$select .= "<option value='$registro->id' $selected>$prefijo$registro->nombre</option>";
	}
	$select .= '</select>';
	return $select;
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
		// alerta('danger', 'Para Acceder al sistema <strong>Debes</strong> Iniciar Sesion');
		header('location:./');
	}
}
function cambiarFormatoFecha($fecha){
	list($yy,$mm,$dd)=explode("-",$fecha);
	$fecha = new DateTime();
	$fecha->setDate($yy, $mm, $dd); 
	return $fecha->format('d-m-Y');
}
// function table($datos, $cabeza){

// }


function Sumamuertes($Mortalidad,$numeroMuertes){
	foreach ($Mortalidad as $key => $value) {
		$numeroMuertes += $Mortalidad[$key]->numeroMuertes;
	}
	return $numeroMuertes;
}

function vacio(array $array){
	$vacio = true;
	foreach ($array as $valor) {
		if (!empty($valor)) {
			$vacio = false;
		}
	}
	return $vacio;
}
function matrizVacia(array $array){
	$vacio = true;
	foreach ($array as $valor) {
		if (!vacio($valor)) {
			$vacio = false;
		}
	}
	return $vacio;
}