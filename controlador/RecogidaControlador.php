<?php
class RecogidaControlador
{
	
	function __construct(){
		$this->ResponsableModelo = new ResponsableModelo();
		$this->GalponModelo = new GalponModelo();
		$this->SectorModelo = new SectorModelo();
		$this->RegistroModelo = new RegistroModelo();
		$this->RecogidaModelo = new RecogidaModelo();
		$this->UsuarioModelo = new UsuarioModelo();
	}

	public function index(){
		loged();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/recogida/InicioRecogida.php';
		require_once 'vista/recogida/AgregarRecogida.php';
		require_once 'vista/recogida/EditarRecogida.php';
		require_once 'vista/recogida/EliminarRecogida.php';
		require_once 'vista/recogida/DetallesRecogida.php';
		require_once 'vista/recogida/AgregarResponsable.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarResponsable(){
		if (isset($_REQUEST['NombreResponsable'], $_REQUEST['ApellidoResponsable']
					, $_REQUEST['Cedula'], $_REQUEST['Nacionalidad'])) 
		{  
			if (preg_match('[a-zA-Z ]+', $_REQUEST['NombreResponsable'])) {
				alerta('danger', 'El nombre del responsable no puede contener caracteres especiales');
				
			} else if(preg_match('[a-zA-Z ]+', $_REQUEST['ApellidoResponsable'])){
				alerta('danger', 'Al apellido del responsable no debe ontener caracteres especiales');
			} else if(!filter_var($_REQUEST['Cedula'],FILTER_VALIDATE_INT)){
				alerta('danger', 'La cedula debe ser un numero entero');
			}else {
				alerta('success', 'Se agregó al Responsable '.$_REQUEST['nombreResponsable'].' Correctamente');
			}			
		}else {
			alerta('danger', 'Introduzca los datos para poder agregar a un Responsable');
		}
		header('location:?c=Recogida');
	}

	public function agregarRegistro(){
		if (isset($_REQUEST['idSector'], $_REQUEST['semana'], 
			$_REQUEST['fecha'])) 
		{
			if (!filter_var($_REQUEST['idSector'],FILTER_VALIDATE_INT)) {
				alerta('danger', '¡El id del Sector debe se un numero entero!');
			} else if (!filter_var($_REQUEST['semana'],FILTER_VALIDATE_INT)) {
				alerta('danger', 'El numero de la Semana debe ser un numero entero');
			} else {
				alerta('success', 'Se agregó la recogida Correctamente');
			}
			// #AGREGAR REGISTRO
			// #AGREGAR LAS RESPECTIVAS VALIDAIONES
			// $idRegistro = $this->RegistroModelo->insert($_REQUEST['idSector'],
			// 											$_REQUEST['semana'],
			// 											$_REQUEST['fecha']	  );
			// #AGREGAR RECOGIDAS
			// foreach ($_REQUEST['recogida'] as $recogida) {
			// 	$idRecogida = $this->RecogidaModelo->insert($idRegistro, $recogida['hora']);
			// 	foreach ($recogida as $key => $valor) {
			// 		if ($key !== 'hora' && !empty($valor)) {
			// 			$this->RecogidaModelo->insertValores($idRecogida, $key, $valor);
			// 		}
			// 	}
			// }

		}else {
			alerta('danger', 'Introduzca los datos para poder agregar una Recogida');
		}
		header('location:?c=Recogida');
	}

	public function agregarUsuario(){
		if (isset($_REQUEST['nombreUsuarioAgregar'], $_REQUEST['claveUsuarioAgregar'])) {
			try {
				$this->UsuarioModelo->incertar(	$_REQUEST['nombreUsuarioAgregar'], 
											$_REQUEST['claveUsuarioAgregar']	);
				alerta('success', 'Se agregó al usuario Correctamente');
			} catch (PDOException $e) {
				alerta('danger', 'Hay algun error en los datos, por favor corrija');
				alerta('danger', $e->getMessage());
			}
		}else {
			alerta('danger', 'Para poder agregar un usuario debes agregar los datos');
		}
		header('location:?c=Recogida');
	}
}