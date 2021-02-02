<?php 

function Numerogallinas($NumeroGallinas){
	$Informe = '';
	if ($NumeroGallinas <= 0 || $NumeroGallinas > 50000 || empty($NumeroGallinas)){
		$Informe = "El número de gallinas no puede ser mayor a 50000 o menor a 1 o estar vacío.";
	}
	return $Informe;
}

function Fechamayor($FechaNueva, $FechaVieja){
	$Informe = '';
	if ($FechaVieja > $FechaNueva ) {
		$Informe = 'El inicio del Lote anterior no puede ser mayor al nuevo.';
	}
	return $Informe;
}

function SinNumeros($Strings){
	$validacion = false;
	foreach ($Strings as $key => $String) {
		if (preg_match('/\d/', $String)) {
			$validacion = true;
		}
	}
	return $validacion;
}

function SinEspecial($Strings){
	$validacion = false;
	foreach ($Strings as $key => $String) {
		if (preg_match('/\W/', $String)) {
			$validacion = true;
		}
	}
	return $validacion;
}

function Novacio($Strings){
	$validacion = false;
	foreach ($Strings as $key => $String) {
		if (strlen($String) == 0) {
			$validacion = true;
		}
	}
	return $validacion;
}

function Comparar($Compara1, $Compara2){
	$validacion = false;
	if ($Compara1 != $Compara2) {
		$validacion = true;
	}
	return $validacion;
}

// class Validaciones
// {
	
// 	function __construct(){}

// 	public function entero($dato){
// 		if (!filter_var($dato,FILTER_VALIDATE_INT)) {
// 			return false;
// 		} else {
// 			return true;
// 		}
// 	}

// 	public function caratEsp ($dato){
// 		if (preg_match('[a-zA-Z ]+', $dato)) {
// 			return true;
// 		} else {
// 			return false;
// 		}
// 	}
// }