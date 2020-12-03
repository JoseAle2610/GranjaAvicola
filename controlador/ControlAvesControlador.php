<?php 
class ControlAvesControlador
{
	
	function __construct(){
		$this->GalponEnLoteModelo = new GalponEnLoteModelo();
		$this->MortalidadModelo   = new MortalidadModelo();
	}

	public function index(){
		loged();
		require_once 'vista/includes/header.php';
		require_once 'vista/includes/menu.php';
		require_once 'vista/ControlAves/InicioControlAves.php';
		require_once 'vista/includes/footer.php';
	}

	public function AgregarMortalidad(){
		if (isset($_REQUEST['Mortalidad'], $_REQUEST['FechaMortalidad'], $_REQUEST['Nombre_Galpon'], $_REQUEST['NumeroGallinas'])){
			$GalponEnLoteModelo = $this->GalponEnLoteModelo->seleccionando(array($_REQUEST['Nombre_Galpon']));
			$datosMortalidadModelo = $this->MortalidadModelo->select('WHERE idGalpon = ? AND idLote = ? ORDER BY fecha DESC', array($GalponEnLoteModelo->idGalpon, $GalponEnLoteModelo->idLote));
			$numeroMuertes = $_REQUEST['Mortalidad'];

			foreach ($datosMortalidadModelo as $key => $value) {
				$numeroMuertes = $datosMortalidadModelo[$key]->numeroMuertes + $numeroMuertes;
			}
		
// else if ($datosMortalidadModelo == NULL) {
// 				alerta('danger', '');
// 				// echo "ERROR";
// 			}
			// $Validando = false;
			if ($_REQUEST['Mortalidad'] <= 0) {
			  	alerta('danger', 'Ingrese un número válido por favor');
		  	} else if($GalponEnLoteModelo->terminado == 1) {
				alerta('danger', 'Disculpe, debe ingresar un nuevo lote ya que no hay ninguno activo en este momento');
			} else if ($_REQUEST['FechaMortalidad'] <= $GalponEnLoteModelo->inicio) {
				alerta('danger', 'Antes o el mismo día en que se agregue un lote no puede morir alguna gallina');
			}else if ($numeroMuertes > $GalponEnLoteModelo->gallinas) {
				alerta('danger', 'Las muertes no pueden superar al número total de gallinas en el lote');
			}  else{
				// if ($datosMortalidadModelo != NULL) {
				// 	if ($datosMortalidadModelo[0] < $_REQUEST['FechaMortalidad']) {
				// 	$Validando = true;
				// 	alerta('danger', 'Ya ingresó la mortalidad de las gallinas en una fecha mayor a esta');
				// 	} else alerta('success', 'Ya ingresó la mortalidad de las gallinas en una fecha mayor a esta');
				// }
				// if ($Validando == false) {
					try {
						$datosMortalidadModelo = array($_REQUEST['Nombre_Galpon'], $GalponEnLoteModelo->idLote, $_REQUEST['Mortalidad'], $_REQUEST['FechaMortalidad']);
						$GalponEnLoteModelo->gallinas = $GalponEnLoteModelo->gallinas - $_REQUEST['Mortalidad'];
						if ($numeroMuertes == $GalponEnLoteModelo->gallinas) {
							$GalponEnLoteModelo->terminado = 1;
							 $GalponEnLoteModelo = array($GalponEnLoteModelo->terminado,
													$GalponEnLoteModelo->gallinas,
													$GalponEnLoteModelo->idGalpon,
													$GalponEnLoteModelo->idLote);
							// $this->GalponEnLoteModelo->update($GalponEnLoteModelo);
						}
						// $this->MortalidadModelo->insert($datosMortalidadModelo);
						alerta('success', 'El número de Gallinas ha sido actualizada');
					} catch (PDOException $e) {
						alerta('danger', 'Ya ingresó las Gallinas que muerieron en esa fecha, galpón y lote');
					}
				}
		}else {
			alerta('danger', 'Introduzca los datos para poder agregar Mortalidad');
		}
		header('location:?c=ControlAves');
	}
}