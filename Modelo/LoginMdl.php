<?php
    /**
	 * @author Javier Rizo Orozco
	 * Model for the login
	 */
	 
	 require("MdlEstandar.php");
	 class LoginModel extends MdlEstandar{
		
		function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($this->bd_driver->connect_errno){
				die("No se pudo conectar porque {$this->bd_driver->connect_error}");
			}
			$this->bd_driver->set_charset("utf8");
		}
		
		function connect($datos){
		
			//First we're going to ask for the students
			$miQuery = "SELECT NOMBRE FROM ALUMNO WHERE CODIGO = '".$datos[0]."' AND CONTRASEÑA = '".$datos[1]."';";
			$result = $this->bd_driver->query($miQuery);
			if($result && $this->bd_driver->affected_rows == 1){
				$todo[] = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
				$usuario['resultado'] = true;
				$usuario['tipo'] = "alumno";
				$usuario['nombre'] = $todo[0];
			}
			else{//If not then we're going to ask for the teachers
				$miQuery = "SELECT NOMBRE FROM MAESTRO WHERE idMaestro = '$datos[0]' AND CONTRASEÑA = '$datos[1]'";
				$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$todo[] = array();
					while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
						$todo[] = $a;
					$usuario['resultado'] = true;
					$usuario['tipo'] = "maestro";
					$usuario['nombre'] = $todo[0];
				}
				else{//The user must be an admin
				
					$miQuery = "SELECT NOMBRE FROM ADMINISTRADOR WHERE idAdministrador = '$datos[0]' AND CONTRASEÑA = '$datos[1]'";
					$result = $this->bd_driver->query($miQuery);
				
					if($result  && $this->bd_driver->affected_rows == 1){
						$todo[] = array();
						while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
							$todo[] = $a;
						$usuario['resultado'] = true;
						$usuario['tipo'] = "admin";
						$usuario['nombre'] = $todo[0];
					}
					else{
						$usuario['resultado'] = false;
					}
				
				}
			
			}
			$this->bd_driver->close();
			return $usuario;
		}
		
		function modifica($datos){
			
			return true;//We are gonna return a true for this time
		}
	 }
	 
?>
