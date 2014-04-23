<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley Ayón
	 *  @since 
	 * 
	 * In this class are put any methods that an Administrator are supossed to do in this case is just one
	 * 
	 * CASE CICLOESCOLAR
	 * in this case the admin want to add a scholar cicle so the teachers can add new course and so on
	 * @param ciclo with this syntaxis "yyyy[A|B]" ex. 2014A
	 * 
	 */
	 
	 require_once("CtrlEstandar.php");
    class AdminCtrl extends CtrlEstandar{
    	public $model;
		
		public function __construct(){//Charge the model Admin
			require('Modelo/AdminMdl.php');
			$this->model = new AdminMdl();
		}
		
		public function ejecutar(){
			if($this->esAdmin())
				if(isset($_POST['accion'])){
					if(preg_match("/[A-Za-z]+/", $_POST['accion'])){
						switch ($_POST['accion']) {
							case 'cicloescolar':
								if(isset($_POST['cicloescolar'])){
									$ciclo = $this->validaCiclo($_POST['cicloescolar']);
								} else{
									$ciclo = false;
								}
								
								if(isset($_POST['fechaInicio']))
									$fechaInicio = $this->validaFecha
								else
									$fechaInicio = false;
									
								if(isset($_POST['fechaFin']))
									$fechaFin = $this->validaFecha
									
								if(isset($_POST['fechasDescanso']))
									$fechasDescanso = $this->validaGrupoFecha(
								else
									$fechasDescanso = false;
									
								if($ciclo && $fechaInicio && fechaFin && $fechasDescanso !== -1)
									$status = true;
								else
									$status = false
								if($status){
									
								
								}else{
								
								
								}
								$status = $this->nuevoCiclo($ciclo);
								if($status){
									include('Vistas/nuevoCiclo.php');
								} else{
									include('Vistas/errorCiclo.php');
								}
								break;
							
							default:
								
								break;
						}
					}
				}
			else{
				include('Vistas/errorPermisos.php');
			}
		}
		public function validaCiclo($ciclo){//validating the year and period of the scholar cicle, assuming less than 100 years this will only accept
			if(preg_match("/20([0-9]{2})[A|B]/",$calificacion))//between 2000 and 2099
				return true;
			else 
				return false;
		}
	}
?>