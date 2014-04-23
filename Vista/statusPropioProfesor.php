<?php

	function datos($datos){
		echo "Hola Profesor {$_SESSION['nombre']}, estos son tus datos";
		foreach($datos as $llave => $valor){
			echo $llave.": ".$valor."</br>";
		}
		
	}
?>