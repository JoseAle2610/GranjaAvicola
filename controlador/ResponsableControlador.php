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
		$activo= isset($_REQUEST['activoResponsable']) ? true : false ;
		if (isset($_REQUEST['NombreResponsable'], $_REQUEST['ApellidoResponsable'], $_REQUEST['Cedula'], $_REQUEST['Nacionalidad'], $_REQUEST['editar'])) 
		{
			$datos = array(	'nombre' 		=> $_REQUEST['NombreResponsable'],
							'apellido' 		=> $_REQUEST['ApellidoResponsable'],
							'nacionalidad' 	=> $_REQUEST['Nacionalidad'],
							'cedula' 		=> $_REQUEST['Cedula'],
							'activo' 		=> $activo 							);
			$datos = (object)$datos;

			if ($_REQUEST['Cedula'] < 3000000 || $_REQUEST['Cedula'] > 40000000) {
			 	alerta('danger', 'Ingrese una cédula válida');
			 } else if (preg_match('[a-zA-Z ]+', $datos->nombre)) {
				alerta('danger', 'El nombre del responsable no puede contener caracteres especiales');
				# NOS ASEGURAMOS DE QUE EL APELLIDO NO CONTENGA CARACTERES ESPECIALES
			} else if(preg_match('[a-zA-Z ]+',$datos->apellido)){
				alerta('danger', 'Al apellido del responsable no debe ontener caracteres especiales');
				# NOS ASEGURAMOS DE QUE LA CEDULA SEA UN ENTERO
			} else if(!filter_var($datos->cedula,FILTER_VALIDATE_INT)){
				alerta('danger', 'La cedula debe ser un numero entero');
			}else {
				# INSERTAMOS O EDITAMOS LOS DATOS
				try {
					$datos = array(	$datos->nombre,
									$datos->apellido,
									$activo,
									$datos->nacionalidad.$datos->cedula);
					if ($_REQUEST['editar'] == false) {
						$this->responsableModelo->insert($datos);
					} else if ($_REQUEST['editar'] == true) {
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