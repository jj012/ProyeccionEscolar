<?php
	/**
	* @author Javier Rizo Orozco
	* View to show the errors that could happen on the process with Alumno
	**/
	function erroresAlta($datosAlumno){//This function gives the reasons that the Alumno couldnt register himself
		if($datosAlumno['nombre'] === false){
			echo "Nombre incorrecto o no agregado </br>";
		}
		if($datosAlumno['correo'] === false){
			echo "Correo incorrecto o no agregado </br>";
		}
		if($datosAlumno['carrera'] === false){
			echo "Carrera incorrecta o no agregada </br>";
		}
		if($datosAlumno['codigo'] === false){
			echo "Codigo incorrecto o no agregado </br>";
		}
	
	}
	
	function falloInsercion(){
		echo "No se logro insertar el alumno </br>";
	}
?>