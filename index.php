<?php
	/**
	  * @author: J. Rizo Orozco
	  * @since: 27/Feb/2014
	  * Practice for validate a string with a regular expression
	  */
	  
	  if(isset($_POST['usuario'])){//Check if in POST exists the user
		if(preg_match("/[A-Za-z]+/",$_POST['usuario'])){ // The string must bee alphabetic
			switch($_POST['usuario']){
				case 'alumno':
					require('Controlador/AlumnoCtrl.php');
					$ctrlAlumno = new AlumnoCtrl();
					break;
				default:
					echo "Usuario invalido </br>";
					break;
			}
			if(isset($ctrlAlumno))
				$ctrlAlumno->ejecutar();
		}
		else
			echo "Entrada de usuario no valida";
	  }
	  else
	  	echo 'No existe el usuario </br>';
?>