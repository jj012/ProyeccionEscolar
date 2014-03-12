<?php
	/**
	* @author Javier Rizo Orozco
	* View to help with the gui of the user Alumno
	**/
	function lista($listado){
	
		for($numero = 0; $numero < count($listado); $numero++){//Imprime la lista de alumnos
			echo "Alumno $numero:", $listado[$numero], "</br>";
		}
	}
	
	function dadoAlta(){//This function gives the message that the student is up on the page
		echo "Estudiante dado de alta";
	
	}
?>