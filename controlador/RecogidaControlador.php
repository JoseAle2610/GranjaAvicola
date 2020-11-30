
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
		$this->ConsultasModelo = new ConsultasModelo();
	}

	public function index(){
		loged();
		$recogidas = $this->ConsultasModelo->infoRecogida();
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

	public function agregarRecogida(){
		if (isset($_REQUEST['idSector'], $_REQUEST['responsable'], 
			$_REQUEST['fecha'], $_REQUEST['recogida'])) 
		{
			#AGREGAR REGISTRO
			#AGREGAR LAS RESPECTIVAS VALIDAIONES
			try {
				$idRegistro = $this->RegistroModelo->insert($_REQUEST['idSector'],
															$_REQUEST['fecha']	  );
				$this->ResponsableModelo->insertResponsableRecogida($idRegistro, $_REQUEST['responsable']);
				#AGREGAR RECOGIDAS
				foreach ($_REQUEST['recogida'] as $recogida) {
					$idRecogida = $this->RecogidaModelo->insert($idRegistro, $recogida['hora']);
					foreach ($recogida as $key => $valor) {
						if ($key !== 'hora' && !empty($valor)) {
							$this->RecogidaModelo->insertValores($idRecogida, $key, $valor);
						}
					}
				}
				alerta('success', 'Se agregó la recogida Correctamente');
			} catch (PDOException $e) {
				alerta('success', 'Ocurrio un error al agregar la recogida');
			}

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