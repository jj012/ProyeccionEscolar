<?php
	
	function datosErroneos($datos){
	
		if(isset($datos['ciclo'] === false)
			echo "No se ha enviado el ciclo </br>";
		else if(isset($datos['ciclo'] === -1)
			echo "Formato de Ciclo erroneo </br>";
		
		if(isset($datos['fechaInicio'] === false))
			echo "Fecha de Inicio no enviada </br>";
		else if(isset($datos['fechaInicio'] === -1))
			echo "Fecha de inicio erronea </br>";
			
		if(isset($datos['fechaFin'] === false))
			echo "Fecha de fin no enviada </br> ";
		else if(isset($datos['fechaFin'] === -1))
			echo "Fecha Erronea </br>";
			
		if(isset($datos['fechasDescanso']) === -1)
			echo "Fechas de descanso erroneas </br>";
	
	}
	
	function rangoErroneoFechas($error){
		switch($error){
			case 'inicioMayor':
				echo "Fecha de inicio mayor que la de fin";
			break;
			
			case 'festivosFueraRango':
				echo "Los dias festivos estan fuera del rango de la fecha de inicio y fin";
			break;
			
			case 'fechasPasadas': //Meaning of the date is less that the date of now
				echo "Las fechas estan atrasadas con la fecha actual, inserte fechas futuras o la fecha de hoy </br>";
			break;
			
			default:
				echo "Error con las fechas </br>";
			break;
		}
	}
	
	function falloInsercion($causa){
		echo "No se logro insertar el ciclo porque {$causa} </br>";
	}
	
	function datosModificar($errores){
		if($errores['ciclo'] === -1){
			echo "Formato de Ciclo incorrecto </br>";
		}
		else if($errores['ciclo'] === false){
			echo "No ha ingresado el ciclo </br>";
		}
		
		if($errores['fechaVieja'] === -1){
			echo "Fecha vieja es incorrecta </br>";
		}
		else if($errores['fechaVieja'] === false){
			echo "No ha ingresado la fecha vieja </br>";
		}
		
		if($errores['fechaNueva'] === -1){
			echo "Fecha nueva incorrecta </br>";
		}
		else if($errores['fechaNueva'] === false){
			echo "Fecha nueva no ingresada </br>";
		}
	}
	
	function falloModifica($causa){
		echo "No se pudo modificar la fecha de asueto porque {$causa} </br>";
	}

?>