
<?php
	class alumnosMdl{

		private $db_driver;
		private $result;

		function __construct(){
			require_once("dbconfig.inc");
		}
		
		function __desconstruct(){
			
		}
		
		function consulta($consulta){
			require_once("dbconfig,inc");
			$db_driver=new mysqli($servidor,$usuario,$pass,$db);
			if($db_driver->connect_error){
				die("No se pudo conectar a la base de datos");
			}else{
				$resultado = $db_driver->query("{$consulta}");
			}
			$db_driver->close();
		}
		
		function cerrarConexion(){
			$db_driver->close();
		}
	}
?>