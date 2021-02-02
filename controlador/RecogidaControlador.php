
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
		$this->GalponEnLoteModelo = new GalponEnLoteModelo();
	}

	public function index(){
		loged();
		$recogidas = $this->ConsultasModelo->infoRecogida();
		$Galpon = $this->GalponModelo->seleccionar();
		
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/recogida/InicioRecogida.php';
		require_once 'vista/recogida/AgregarRecogida.php';
		require_once 'vista/includes/footer.php';
	}

	public function agregarRecogida(){
		if (isset($_REQUEST['idSector'], $_REQUEST['responsable'], $_REQUEST['fecha'])) {

			#AGREGAR REGISTRO
			#AGREGAR LAS RESPECTIVAS VALIDAIONES
			try {
				$horas = array('09:00','14:00','18:00');
				if ($_REQUEST['editRecogida'] == 1) {
					foreach ($_REQUEST['recogidaEditarValor'] as $idRecogida => $recogida) {
						foreach ($recogida as $idCategoria => $valor) {
							$this->RecogidaModelo->updateValores($idRecogida, $idCategoria, $valor);
						}
					}
					foreach ($_REQUEST['recogidaAgregarValor'] as $idRecogida => $recogida) {
						foreach ($recogida as $idCategoria => $valor) {
							if (!empty($valor)) {
								$this->RecogidaModelo->insertValores($idRecogida, $idCategoria, $valor);
							}
						}
					}
					if (isset($_REQUEST['recogidaValor'], $_REQUEST['idRegistro'])) {
						foreach ($_REQUEST['recogidaValor'] as $fila => $recogida) {
							if (!vacio($recogida)) {
								$idRecogida = $this->RecogidaModelo->insert($_REQUEST['idRegistro'], $horas[$fila]);
								foreach ($recogida as $idCategoria => $valor) {
									if (!empty($valor)) {
										$this->RecogidaModelo->insertValores($idRecogida, $idCategoria, $valor);
									}
								}
							}
						}
					}
					alerta('success', 'Se actualizó correctamente la Recogida.');
				} else {
					if (matrizVacia($_REQUEST['recogidaValor'])==false) {
						$SectorModelo = $this->SectorModelo->selectById($_REQUEST['idSector']);
						$SectorModelo = $this->GalponEnLoteModelo->seleccionando(array($SectorModelo->idGalpon));
						$idRegistro = $this->RegistroModelo->insert(array($_REQUEST['idSector'], $_REQUEST['fecha'], $SectorModelo->idGalpon, $SectorModelo->idLote)); 
						$this->ResponsableModelo->insertResponsableRecogida($idRegistro, $_REQUEST['responsable']);
						// // #AGREGAR RECOGIDAS

						foreach ($_REQUEST['recogidaValor'] as $fila => $recogida) {
							if (!vacio($recogida)) {
								$idRecogida = $this->RecogidaModelo->insert($idRegistro, $horas[$fila]);
								foreach ($recogida as $idCategoria => $valor) {
									if (!empty($valor)) {
										$this->RecogidaModelo->insertValores($idRecogida, $idCategoria, $valor);
									}
								}
							}
						}
						alerta('success', 'Se agregó correctamente la Recogida.');
					}else{
						alerta('danger', 'Introduzca los datos para poder agregar una Recogida.');
					}
				}
			} catch (PDOException $e) {
				alerta('danger', 'Ocurrió un error al agregar la Recogida.');
			}

		}else {
			alerta('danger', 'Introduzca los datos para poder agregar una Recogida.');
		}
		header('location:?c=Recogida');
	}
}