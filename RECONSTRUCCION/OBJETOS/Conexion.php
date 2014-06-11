
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
		
		function limpiaSQL($variables) {//Posibility to use with the other controllers because is more standard this function
			foreach ($variables as $llave => $valor) {
				if (is_string($valor)) {
					$valor = ltrim($valor);
					$valor = rtrim($valor);
					$variables[$llave] = $valor;
				}
			}//Look this wonderful code :D we are gonna to use to another controllers to clean the values.

			return $variables;
		}
	}
?>