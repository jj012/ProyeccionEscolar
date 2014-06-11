<?php

	
	interface MdlEstandar{
		protected $bd_driver;
		
			function __construct(){
			}
			
			function abreConexion(){
				require("dbconfig.inc");
				$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
				if($this->bd_driver->connect_errno){
					die("No se pudo conectar porque {$this->bd_driver->connect_error}");
				}
			}
			
			function cierraConexion(){
				$this->bd_driver->close();
				if($this->bd_driver->connect_errno){
					die("Hubo un problema al cerrar la conexio {$this->bd_driver->connect_error}");
				}
			}
	
	}
	
?>