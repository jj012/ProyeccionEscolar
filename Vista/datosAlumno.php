<?php

	function datosAlumno($datos){//Results of a consult from a student with success
		$presentacion;
		if($_SESSION['tipo'] === 'admin')
			$presentacion = "Hola administrador {$_SESSION['nombre']} </br>";
		else
			$presentacion = "Hola maestro {$_SESSION['nombre']} </br>";
			
		echo $presentacion."Estos son los datos del estudiante </br>";
			
		foreach($datos as $llave => $valor){
			echo $llave.": ".$valor."</br>";
		}
	}
?>
