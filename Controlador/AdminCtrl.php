<?php
    /**
	 * @author Jesus Alberto Ley Ayon
	 *  @since 
	 * 
	 */
    class AdminCtrl{
    	public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/MaestroMdl.php');
			$this->model = new MaestroModel();
		}
		
		public function ejecutar(){
			if(isset($_POST['accion'])){
				if(preg_match("/[A-Za-z]+/", $_POST['accion'])){
					switch ($_POST['accion']) {
						case 'cicloescolar':
							if(isset($_POST['cicloescolar'])){
								$ciclo = $this->validaCiclo($_POST['cicloescolar']);
							} else{
								$ciclo = false;
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
		}
	}
?>