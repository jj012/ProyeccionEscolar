<?php
    /**
	 * @author Javier Rizo Orozco
	 * Model for the login
	 */
	 
	 require("MdlEstandar.php");
	 class LoginModel extends MdlEstandar{
	 	public $bd_driver;
		
		function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($this->bd_driver->connect_errno){
				die("No se pudo conectar porque {$bd_driver->connect_error}");
			}
		}
		
		function connect($datos){
			$miQuery = "SELECT * FROM ALUMNO";
			$result = $this->bd_driver->query($miQuery);
			
			
			//Buscar error antes de extraer
			
			//Realiza todo :_:
			$todo[] = array();
			while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
				$todo[] = $a;
			return $todo;
		}
		
		function modifica($datos){
			
			return true;//We are gonna return a true for this time
		}
	 }
	 
?>
