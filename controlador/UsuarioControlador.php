<?php 
/**
 * 
 */
class UsuarioControlador
{
	
	function __construct(){
		$this->responsableModelo = new ResponsableModelo();
		$this->UsuarioModelo = new UsuarioModelo();
	}

	public function index(){
		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 'recogida' ;
		header('location:?c='.$pagina);
	}

	public function guardarUsuario() {
		$activoUsuario= isset($_REQUEST['activoUsuario']) ? 1 : 0 ;
		if (isset($_REQUEST['nombreUsuarioAgregar'], $_REQUEST['claveUsuarioAgregar'], $_REQUEST['preguntaUsuarioAgregar'], $_REQUEST['RespuestaUsuarioAgregar'], $_REQUEST['editar'])) 
		{
			$datos = array(	$_REQUEST['nombreUsuarioAgregar'],
							$_REQUEST['claveUsuarioAgregar'],
							$activoUsuario,
							$_REQUEST['preguntaUsuarioAgregar'],
							$_REQUEST['RespuestaUsuarioAgregar'],
							$_REQUEST['Cedula']);
			if (strlen($datos[0]) > 20) {
				alerta('danger', 'El nombre del usuario esta muy largo');
			} else if(!is_string($datos[0])){
				alerta('danger', 'El nombre del usuario no debe contener números ni caracteres especiales');
			}else if(!preg_match('[a-zA-Z ]+',$datos[1])){
				alerta('danger', 'La respuesta de seguridad del usuario no debe contener números ni caracteres especiales');
			}else {
				try {
					if ($_REQUEST['editar'] == false) {
						$this->UsuarioModelo->insertar($datos);
					 } else if ($_REQUEST['editar'] == true) {
						$this->responsableModelo->update($datos);
					}
					alerta('success', 'Se agregó al Responsable '.$_REQUEST['nombreResponsable'].' Correctamente');
				} catch (PDOException $e) {
					alerta('danger', 'Ha ocurrido un error al agregar al Responsable');
					alerta('danger', $e->getMessage());
				}
			}
			
			

		} else alerta('danger', 'ESTA VACIO ALGUN CAMPO');
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