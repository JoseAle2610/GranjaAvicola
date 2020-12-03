<?php 
/**
 * 
 */
class ResponsableControlador
{
	
	function __construct(){
		$this->responsableModelo = new ResponsableModelo();
	}

	public function index(){
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}

	public function guardarResponsable() {
		var_dump($_REQUEST);
		$activo= isset($_REQUEST['activoResponsable']) ? true : false ;
		if (isset($_REQUEST['NombreResponsable'], $_REQUEST['ApellidoResponsable'], $_REQUEST['Cedula'], $_REQUEST['Nacionalidad'], $_REQUEST['editar'])) 
		{
			$datos = array(	'nombre' 		=> $_REQUEST['NombreResponsable'],
							'apellido' 		=> $_REQUEST['ApellidoResponsable'],
							'nacionalidad' 	=> $_REQUEST['Nacionalidad'],
							'cedula' 		=> $_REQUEST['Cedula']);
			$datos = (object)$datos;

			if (!filter_var($datos->cedula,FILTER_VALIDATE_INT)) {
			 	alerta('danger', 'La cedula debe ser un numero entero');
			} else if (preg_match('/\d/', $_REQUEST['NombreResponsable']) || preg_match('/\d/', $_REQUEST['ApellidoResponsable'])) {
			 	alerta('danger', 'El Nombre o Apellido del Responsable no puede tener números');
			} else if(strlen($_REQUEST['NombreResponsable']) == 0 || strlen($_REQUEST['NombreResponsable']) == 0){
				alerta('danger', 'El nombre o apellido del responsable no debe estar vacío');
			} else if (preg_match('/\W/', $_REQUEST['NombreResponsable']) || preg_match('/\W/', $_REQUEST['ApellidoResponsable'])) {
			 	alerta('danger', 'El Nombre o Apellido del Responsable no puede tener caracteres especiales');
			} else if($_REQUEST['Cedula'] < 3000000 || $_REQUEST['Cedula'] > 40000000){
				alerta('danger', 'Ingrese una cédula válida');
			} else {
				# INSERTAMOS O EDITAMOS LOS DATOS
				try {
					$datos = array(	$datos->nombre,
									$datos->apellido,
									1,
									$datos->nacionalidad.$datos->cedula);
					if ($_REQUEST['editar'] == false) {
						$this->responsableModelo->insert($datos);
					} else if ($_REQUEST['editar'] == true) {
						$datos[2] = $activo;
						$this->responsableModelo->update($datos);
					}
					alerta('success', 'Se agregó al Responsable '.$_REQUEST['nombreResponsable'].' Correctamente');
				} catch (PDOException $e) {
					alerta('danger', 'Ha ocurrido un error al agregar al Responsable');
					alerta('danger', $e->getMessage());
				}
			}

		}
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}

	public function eliminarResponsable(){
		$ci = isset($_REQUEST['ci']) ? $_REQUEST['ci'] : '';
		if (!empty($ci)) {
			try {
				$this->responsableModelo->delete($ci);
				alerta('success', 'Responsable eliminado Correctamente');
			} catch (PDOException $e) {
				alerta('danger', 'Ha ocurrido un error a la hora de eliminar al responsable');
			}
		} else {
			alerta('danger', 'Para eliminar al responsable debe facilitar la Cedula');
		}
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}


}