<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley Ayón
	 *  @since 
	 * 
	 */
	 require("MdlEstandar.php");
    class AdminMdl extends MdlEstandar{
	
		function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($this->bd_driver->connect_errno){
				die("No se pudo conectar porque {$this->bd_driver->connect_error}");
			}
			$this->bd_driver->set_charset("utf8");
		}
	
		public function nuevoCiclo($ciclo){//Two querys D:
		
			$miQuery = "INSERT INTO CICLO VALUES('{$ciclo['ciclo']}', '{{$ciclo['fechaInicio']}', '{$ciclo['fechaFin']}', {$ciclo['usuario']}";

			$result = $this->bd_driver->query($miQuery);
			$alta = array();
			
			if($result && $this->bd_driver->affected_rows == 1){
				$alta[0] = true;
				if(isset($ciclo['festivos'])){
					$miQuery = "INSERT INTO diadescanso VALUES(";
					$alta[0] = true;
					foreach($ciclo['festivos'] as $fecha){
						$miQuery2 = $miQuery . "'{$fecha}', '{$ciclo['ciclo']}')";
						$result = $this->bd_driver->result($miQuery2);
						if(!$result || $this->bd_driver->affected_rows != 1){
							$alta[0] = false;
							$alta[1] = $this->bd_driver->error;
							break;
						}
					}
				}
			}else{
				$alta[0] = false;
				$alta[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $alta;
		}
		
		public function eliminaDescanso($datos){
			$miQuery = "DELETE FROM DIADESCANSO WHERE FECHA = '{$datos['fechaBorrar']}' AND Ciclo_idCiclo = '{$datos['ciclo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$modifica[0] = true;
			
			}else{
				$modifica[0] = false;
				$modifica[1] = $this->bd_driver->error;
			}
			$this->bd_driver->close();
			return $modifica;
		}
	
		public function modificaCiclo($datos){
			$miQuery = "UPDATE diadescanso set fecha = '{$datos['fechaNueva']}' WHERE CICLO = '{$datos['ciclo']}' AND fecha = '{$datos['fechaModificar']}' ";
		
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$modifica[0] = true;
				
				$miQuery2 = "DELETE FROM ASISTENCIA WHERE fecha = '{$datos['fechaNueva']}' "; //DELETE DAYS OF REST, we use the new day of rest because there no class to asistancs that's days
				
				$result = $this->bd_driver->query($miQuery2);
				
				if($this->bd_driver->error === NULL){
					
					$modifica[0] = false;
					$modifica[1] = $this->bd_driver->error;
				}
			
			}else{
				$modifica[0] = false;
				$modifica[1] = $this->bd_driver->error;
			}
			
			
			$this->bd_driver->close();
			return $modifica;
		}
	}
	
?>