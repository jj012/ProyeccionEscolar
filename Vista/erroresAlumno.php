<?php
	/**
	* @author Javier Rizo Orozco
	* View to show the errors that could happen on the process with Alumno
	**/
	function erroresAlta($datosAlumno){//This function gives the reasons that the Alumno couldnt register himself
		if($datosAlumno['nombre'] === false){
			echo "Nombre no agregado </br>";
		}
		else if($datosAlumno['nombre'] === -1){
			echo "Nombre incorrecto </br>";
		}
		
		if($datosAlumno['correo'] === false){
			echo "Correo no agregado </br>";
		}
		else if($datosAlumno['correo'] === -1){
			echo "Correo incorrecto </br>";
		}
		if($datosAlumno['carrera'] === false){
			echo "Carrera no agregada</br>";
		}
		else if($datosAlumno['carrera'] === -1){
			echo "Carrera no valida </br>";
		}
		if($datosAlumno['codigo'] === false){
			echo "Codigo no agregado </br>";
		}
		else if($datosAlumno['codigo'] === -1){
			echo "Codigo incorrecto </br>";
		}
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
			echo "Alumno no encontrado </br>";
			break;
			default:
			echo "Fallo con el codigo </br>";
			break;
		}
	}
	
	function falloOpcionales($datos){//This function give the field with an error
		if($datos['url'] === -1)
			echo "URL incorrecta </br>";
		if($datos['git'] === -1)
			echo "Cuenta de git erronea </br>";
		if($datos['celular'] === -1)
			echo "Numero de celular erroneo </br>";
		if($datos['equipo'] === -1)
			echo "Nombre del equipo erroneo </br>";
	}
	
	function falloInsercion(){ //Message to show the fail to insert on the database the student
		echo "No se logro insertar el alumno </br>";
	}
