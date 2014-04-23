<?php

	function datos($datos){
		$presentacion;
		if($_SESSION['tipo'] === 'admin')
			$presentacion = "Hola administrador {$_SESSION['nombre']} </br>";
		else
			$presentacion = "Hola alumno {$_SESSION['nombre']} </br>";
			
			
		echo $presentacion."Estos son los datos del profesor </br>";
			
		foreach($datos as $llave => $valor){
			echo $llave.": ".$valor."</br>";
		}
	}

?>