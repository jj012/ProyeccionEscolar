<?php
	/**
	 * @author: J. Rizo Orozco & Jesus Alberto Ley Ayón
	 * @since: 27/Feb/2014
	 * @version Alpha
	 * Project J&J ProyeccionEscolar
	 * In this project we are going to make a Online Qualifications Systems for some school 
	 * trying to cover the most important task that concerns teachers, admins and students
	 * the URL for the index.php is (when we get the web page up in the server) 
	 * www.proyeccionescolar.co.nf/index.php?usuario='alumno'&accion='alta' 
	 * 
	 * @param usuario This describes to where the controller is passed to, there are 3 users 'alumno' 'maestro' 'admin'
	 * @param accion This describes what action is taking depends on each user
	 * if theres no valid user or actions, appears a error message
	 */
	 //$_POST['ctrl']='alumno';
	 /*
	 $_POST['usuario'] ='alumno';
	 $_POST['acccion']='listar';
	 $_POST['grupo']='CC001';
	 $_POST['ord']='1';
	 $_POST['nombre']='Jesus Alberto Ley Ayon';
	 $_POST['correo']='jesus_ayon@hotmail.com';
	 $_POST['codigo']='206587305';
	 $_POST['carrera']='01';
	 $_POST['url']='https://bewtenue.net/index.php';
	 $_POST['git']='bewtenue123';
	 $_POST['celular']='3313845969';
	 $_POST['equipo'] = 'J&J';*/
	 
	 if (!isset($_SESSION)){ //We ask first of the session 
		session_start();
		$_POST['usuario'] = 'login';
		$_POST['accionL'] = 'login';
	}
	 	  
	  if(isset($_POST['usuario'])){//Check if in POST exists the user
		if(preg_match("/[A-Za-z]+/",$_POST['usuario'])){ // The string must be alphabetic
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
					break;
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
