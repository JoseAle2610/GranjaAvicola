<?php 
/**
 * 
 */
class Validaciones
{
	
	function __construct(){}

	public function entero($dato){
		if (!filter_var($dato,FILTER_VALIDATE_INT)) {
			return false;
		} else {
			return true;
		}
	}

	public function caratEsp ($dato){
		if (preg_match('[a-zA-Z ]+', $dato)) {
			return true;
		} else {
			return false;
		}
	}
}