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
		require_once 'vista/galpon/CambiarLote.php';
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
			if ($_REQUEST['Mortalidad'] <= 0) {
			  	alerta('danger', 'Ingrese un número válido por favor');
		  	} else if($GalponEnLoteModelo->terminado == 1) {
				alerta('danger', 'Disculpe, debe ingresar un nuevo lote ya que no hay ninguno activo en este momento');
			} else if ($_REQUEST['FechaMortalidad'] <= $GalponEnLoteModelo->inicio) {
				alerta('danger', 'Antes o el mismo día en que se agregue un lote no puede morir alguna gallina');
			}else if ($numeroMuertes > $GalponEnLoteModelo->gallinas) {
				alerta('danger', 'Las muertes no pueden superar al número total de gallinas en el lote');
			}  else{
					try {
						$datosMortalidadModelo = array($_REQUEST['Nombre_Galpon'], $GalponEnLoteModelo->idLote, $_REQUEST['Mortalidad'], $_REQUEST['FechaMortalidad']);
						echo "GALPON EN LOTE MODELO";
						var_dump($GalponEnLoteModelo->gallinas); echo "NUMERO MUERTES";
						var_dump($numeroMuertes);
						if ($numeroMuertes == $GalponEnLoteModelo->gallinas) {
							alerta('warning', "Recuerde cambiar el lote ya que este finalizó, para ello vaya al módulo de Galpón.Presione aquí  <button idGalpon='$GalponEnLoteModelo->idGalpon' class='btn btn-info cambiarLote' data-toggle='modal' data-target='#CambiarLote'><i class='fas fa-exchange-alt pl-1'>Lote</i> </button>");
						}
						$this->MortalidadModelo->insert($datosMortalidadModelo);
						alerta('success', 'El número de Gallinas ha sido actualizada');
					} catch (PDOException $e) {
						alerta('danger', 'Ya ingresó las Gallinas que muerieron en esa fecha, galpón y lote'); echo "ERROR";
					}
				}
		}else {
			alerta('danger', 'Introduzca los datos para poder agregar Mortalidad');
		}
		header('location:?c=ControlAves');
	}
}