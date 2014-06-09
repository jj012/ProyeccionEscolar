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
								$this->altaCiclo();
								break;
								
							case 'modificaciclo':
								$this->modificaCiclo();
								break;
								
							case 'eliminaFechaDescansoCiclo':
								$this->eliminaDescanso();
							
							default:
								
								break;
						}
					}
				}
			else{
				include('Vistas/errorPermisos.php');
			}
		}
		
		public function eliminaDescanso(){
			if(isset($_POST['cicloescolar'])){
				$ciclo = $this->validaCiclo($_POST['cicloescolar']);
			}
			else
				$ciclo = false;
				
			if(isset($_POST['fechaBorrar'])){
				$fechaBorra = $this->validaFecha($_POST['fechaBorrar']);
			}
			else
				$fechaBorra = false;
				
			if($ciclo && $fechaBorra){
				$datos = array();
				$datos['fechaBorrar'] = $this->formatoFecha($_POST['fechaBorrar']);
				$datos['ciclo'] = $this->limpiaDato($_POST['ciclo']);
				
				$elimina = $this->model->eliminaDescanso($datos);
				
				if($elimina[0]){
					include('Vista/cicloModificado.php');
				}else{
					include('Vista/erroresCiclo.php');
					falloModifica($elimina[1]);
				}
			}
		
		}
		
		public function altaCiclo(){
			if(isset($_POST['cicloescolar'])){
				$ciclo = $this->validaCiclo($_POST['cicloescolar']);
			}else{
				$ciclo = false;
			}
								
			if(isset($_POST['fechaInicio']))
				$fechaInicio = $this->validaFecha($_POST['fechaInicio']);
			else
				$fechaInicio = false;
									
			if(isset($_POST['fechaFin']))
				$fechaFin = $this->validaFecha($_POST['fechaFinal']);
			else
				$fechaFin = false;
									
			if(isset($_POST['fechasDescanso']))
				$fechasDescanso = $this->validaGrupoFecha($_POST['fechasDescanso']);
			else
				$fechasDescanso = false;
									
			if($ciclo && $fechaInicio && fechaFin && $fechasDescanso !== -1)
				$status = true;
			else
				$status = false
			if($status){
				//Procced to verify the range with the dates.
				$fechasClase = array ('inicio' => $_POST['fechaInicio'], 'fin' => $_POST['fechaFin']);
				if($fechasDescanso)//Dates of resting
					$fechasClase['festivos'] = $_POST['fechasDescanso']
					$status = $this->verificaRangoFechas($fechasClase);
					if($status[0]){//Prepare the data;
						$datos = array();
						$datos['fechaInicio'] = $this->formatoFecha($_POST['fechaInicio']);
						$datos['fechaFin'] = $this->formatoFecha($_POST['fechaFin']);
						$datos['ciclo'] = $this->limpiaDato($_POST['ciclo']);
						$datos['usuario'] = $_SESSION['user'];
										
						if($fechaDescanso){
							$datos['festivos'] = $this->formatoGrupoFechas($_POST['fechasDescanso']);
						}
										
						$insertaCiclo = $this->model->nuevoCiclo($datos);
										
						if($insertaCiclo[0]){
							include('Vista/altaCiclo.php');
						}else{//Error to insert the cycle
							include('Vista/erroresCiclo.php');
							falloInsercion($insertaCiclo[1]);
						}
									
					}else{
						include('Vista/erroresCiclo.php');
						rangoErroneoFechas($status[1]);
					}
								
			}else{
				$errores = array('ciclo' => $ciclo, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'fechasDescanso' => $fechasDescanso);
				include('Vista/erroresCiclo.php');
				datosErroneos($errores);
			}
		}
		
		public function modificaCiclo(){
			if(isset($_POST['fechaModificar']))
				$fechaModificar = $this->validaFecha($_POST['fechaModificar']);
			else
				$fechaModificar = false;
			
			if(isset($_POST['ciclo']))
				$ciclo = $this->validaCiclo($_POST['ciclo']);
			else
				$ciclo = false;
				
			if(isset($_POST['fechaNueva']))
				$fechaNueva = $this->validaFecha($_POST['fechaNueva']);
			else
				$fechaNueva = false;
				
			if($fechaModificar && $ciclo && $fechaNueva){
				$datos = array();
				$datos['fechaVieja'] = $this->formatoFecha($_POST['fechaModificar']);
				$datos['fechaNueva'] = $this->formatoFecha($_POST['fechaNueva']);
				$datos['ciclo'] = $this->limpiaDato($_POST['ciclo']);
				
				$modifica = $this->model->modificaCiclo($datos);
				
				if($modifica[0]){
					include('Vista/cicloModificado.php');
				}else{
					include('Vista/erroresCiclo.php');
					falloModifica($modifica[1]);
				}
			
			}else{
				$errores = array('ciclo' => $ciclo, , 'fechaVieja' => $fechaModificar, 'fechaNueva' => $fechaNueva);
				include('Vista/erroresCiclo.php');
				datosModificar($errores);
			}
		
		}
		
		
		public function validaCiclo($ciclo){//validating the year and period of the scholar cicle, assuming less than 100 years this will only accept
			$ciclo = $this->limpiaDato($ciclo);
			if(preg_match("/20([0-9]{2})[A|B]/",$ciclo))//between 2000 and 2099
				return true;
			else 
				return false;
		}
		
		public function limpiaDato($dato){
			$dato = ltrim($dato);
			$dato = rtrim($dato);
			return $dato;
		}
		
		public function formatoFecha($fecha){
			$fecha = $this->limpiaDato($fecha);
			$fecha = DateTime::createFromFormat('d/m/Y', $fecha);
			$fecha = $fecha->format('Y-m-d');
			
			return $fecha;
		}
		
		public function formatoGrupoFechas($fechas){
			$arreglo = array();
			
			foreach($fechas as $fecha){
				$fecha = $this->formatoFecha($fecha);
				$arreglo[] = $fecha;
			}
			return $arreglo;
		}
		
		public function validaFecha($fecha){ //Function to validate the date
			$fecha = $this->limpiaDato($fecha);
			$expresion = "/([123]0|[012][1-9]|31)\/(0[1-9]|1[012])\/(19[0-9]{2}|2[0-9]{3})/";
			if(preg_match($expresion, $fecha))
				return true
			else
				return -1;
		}
			
		public function validaGrupoFecha($fechas){//Same function but to validate more dates
			foreach($fechas as $fecha){
				if($this->validaFecha($fecha) === -1){
					return -1;
				}
			}
			return true;
		}
		
		public function verificaRangoFechas($fechasCiclo){
			$fechaInicio =  DateTime::createFromFormat('d/m/Y', $fechasCiclo['fechaInicial']);
			$fechaFin =  DateTime::createFromFormat('d/m/Y', $fechaCiclo['fechaFin']);
			$fechaActual = new DateTime("NOW");
			if(isset($fechasCiclo['festivos'])){
				$asuetos = $fechasCiclo['festivos'];
				$asuestosFormato = array();
				foreach($asuetos as $dia);{
					$asuetosFormato[] =  DateTime::createFromFormat('d/m/Y', $dia);
				}
			}
		
			$validacion = array(0 => false);
			if($fechaInicio > $fechaFin){
				$validacion[1] = "inicioMayor";
			}
			else if($fechaActual > $fechaInicio || $fechaActual > $fechaFin){
				$validacion[1] = "fechasPasadas";
			}
			else if(isset($asuetosFormato)){
				foreach($asuetosFormato as $asueto){
					if($asueto < $fechaInicio){
						$validacion[1] = "festivosFueraRango";
						break;
					}
				}
			}else{
				$validacion[0] = true;
			}
			return $validacion;
		}
	}
?>