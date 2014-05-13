<?php
	function  errorAlta($causa){
	
		 echo "Error al insertar el curso por '{$causa}' </br>";
	}
	
	function errorDatosAlta($datos){
	
		foreach($datos as $llave => $valor){
			if($valor === -1)
				echo "{$llave]} incorrecto </br>";
			else if($valor === false)
				echo "{$llave} no agregada </br>";
		}
		
	}
 
?>