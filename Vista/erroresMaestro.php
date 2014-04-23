<?php
	function errorAlta($datos){
		if($datos['nombre'] === false)
			echo "Nombre no enviado </br>";
		else if($datos['nombre'] === -1)
			echo "Nombre incorrecto </br>";
			
		if($datos['codigo'] === false)
			echo "ID no enviado </br>";
		else if($datos['codigo'] === -1)
			echo "ID incorrecto </br>";
			
		if($datos['correo'] === false)
			echo "Correo no enviado </br>";
		else if($datos['correo'] === -1)
			echo "Correo incorrecto </br>";
		
		if($datos['contraseña'] === false)
			echo "Contraseña no enviada </br> ";
		else if($datos['contraseña'] === -1)
			echo "Contraseña incorrecta </br>";
	
	}
	
	function errorInsercion($causa){
		echo "No se logro insertar al maestro porque </br> {$causa}";
	}
	
	function errorBaja($codigo){
		if($codigo === -1)
			echo "Codigo incorrecto </br>";
		else if($codigo === false)
			echo "No se ha enviado codigo </br>";
	}
	
	function falloBaja($causa){
		echo "No se pudo dar de baja porque {$causa}";
	}
	
	function fallos($caso){
		switch($caso){
			case 1:
			echo "Codigo no enviado </br>";
			break;
			case 2:
			echo "Codigo incorrecto </br>";
			break;
			case 3:
			echo "Profesor no encontrado </br>";
			break;
			default:
			echo "Fallo con el codigo </br>";
			break;
		}
	}
?>