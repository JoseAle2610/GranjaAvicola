<?php 
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
		$activo = isset($_REQUEST['activoResponsable']) ? true : false ;
		if (isset($_REQUEST['NombreResponsable'], $_REQUEST['ApellidoResponsable'], $_REQUEST['Cedula'], $_REQUEST['Nacionalidad'], $_REQUEST['editar'])) {
			$datos = array(	'nombre' 		=> $_REQUEST['NombreResponsable'],
							'apellido' 		=> $_REQUEST['ApellidoResponsable'],
							'nacionalidad' 	=> $_REQUEST['Nacionalidad'],
							'cedula' 		=> $_REQUEST['Cedula']);
			$datos = (object)$datos;

			if (!filter_var($datos->cedula,FILTER_VALIDATE_INT)) {
			 	alerta('danger', 'La cédula debe ser un número entero.');
			} else if (SinNumeros(array($_REQUEST['NombreResponsable'],$_REQUEST['ApellidoResponsable'])) == true) {
			 	alerta('danger', 'El nombre o apellido del Responsable no puede contener números.');
			} else if(Novacio(array($_REQUEST['NombreResponsable'],$_REQUEST['ApellidoResponsable'])) == true){
				alerta('danger', 'El nombre o apellido del responsable no debe estar vacío.');
			} else if (SinEspecial(array($_REQUEST['NombreResponsable'],$_REQUEST['ApellidoResponsable'])) == true) {
			 	alerta('danger', 'El nombre o apellido del Responsable no puede contener caracteres especiales.');
			} else if($_REQUEST['Cedula'] < 3000000 || $_REQUEST['Cedula'] > 40000000){
				alerta('danger', 'Ingrese una cédula válida.');
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
						if ($_REQUEST['NombreResponsable'] == "Edith") {
							$datos[2] = 1;
							$datos[0] = "Edith";
						} else{
							$datos[2] = $activo;
						}
							$this->responsableModelo->update($datos);
					}
					alerta('success', 'Se agregó al Responsable '.$_REQUEST['NombreResponsable'].' Correctamente.');
				} catch (PDOException $e) {
					alerta('danger', 'Ha ocurrido un error al agregar al Responsable.');
				}
			}
		}
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}
}