<?php

	function falloError($datosObligados){
		if($datosObligados['nombre'] === -1)
			echo "Nombre incorrecto </br>";
		if($datosObligados['correo'] === -1)
			echo "Correo incorrecto </br>";
		if($datosObligados['carrera'] === -1)
			echo "Carrera incorrecta </br>";
		if($datosObligados['contraseña'] === -1)
			echo "Contraseña incorrecta </br>";
		if($datosObligados['url'] === -1)
			echo "URL incorrecta </br>";
		if($datosObligados['git'] === -1)
			echo "Cuenta git incorrecta </br>";
		if($datosObligados['celular'] === -1)
			echo "Numero de celular incorrecto </br>";
		if($datosObligados['codigo'] === -1)
			echo "Formato de codigo incorrecto </br>";
		else if($datosObligados['codigo'] === false)
			echo "No ha enviado el codoigo del estudiante </br>";
			
	}
	
	function sinModificar(){
		echo "No envio ningun dato </br>";
	}
	
	function falloModificacion($causa){
		echo "No se pudo actualizar el alumno porque </br> {$causa}";
	
	}
?>