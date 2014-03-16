<?php
	/**
	  * @author: J. Rizo Orozco
	  * @since: 27/Feb/2014
	  * Practice for validate a string with a regular expression
	  */
	 //$_POST['ctrl']='alumno';
	 $_POST['acccion']='listar';
	 $_POST['usuario'] ='alumno';
	 $_POST['grupo']='CC001';
	 $_POST['ord']='1';
	 $_POST['nombre']='Jesus Alberto Ley Ayon';
	 $_POST['correo']='jesus_ayon@hotmail.com';
	 $_POST['codigo']='206587305';
	 $_POST['carrera']='01';
	 $_POST['url']='https://bewtenue.net/index.php';
	 $_POST['git']='bewtenue123';
	 $_POST['celular']='3313845969';
	 $_POST['equipo'] = 'J&J';
	 
	  
	  
	  
	  if(isset($_POST['usuario'])){//Check if in POST exists the user
		if(preg_match("/[A-Za-z]+/",$_POST['usuario'])){ // The string must bee alphabetic
			switch($_POST['usuario']){
				case 'alumno':
					require('Controlador/AlumnoCtrl.php');
					//$ctrlAlumno = new AlumnoCtrl();
					$controlador = new AlumnoCtrl();
					break;
				case 'maestro':
					require('Controlador/MaestroCtrl.php');
					$controlador = new MaestroCtrl();
					break;
				case 'login'://Controller for Login
					require('Controlador/LoginCtrl.php');
					$controlador = new LoginCtrl();
				case 'admin':
					require('Controlador/AdminCtrl.php');
					$controlador = new AdminCtrl();
					break;					
				default:
					echo "Usuario invalido </br>";
					break;
			}
			//if(isset($ctrlAlumno))
			if(isset($controlador))
				//$ctrlAlumno->ejecutar();
				$controlador->ejecutar();
		}
		else
			echo "Entrada de usuario no valida";
	  }
	  else
	  	echo 'No existe el usuario </br>';
?>
