<?php

	function falloError($datos){
		if($datos['codigo'] === -1)
			echo "Codigo erroneo </br>";
		else if($datos['codigo'] === false)
			echo "Codigo no enviado </br>";
		
		if($datos['nombre'] === -1)
			echo "Nombre erroneo </br>";
		
		if($datos['correo'] === -1)
			echo "Correo erroneo </br>";
		
		if($datos['contraseña'] === -1)
			echo "Contraseña erronea </br>";
	
	}
?>