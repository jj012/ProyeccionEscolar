<?php
	/**
	 * @author: J. Rizo Orozco & Jesus Alberto Ley Ayón
	 * @since: 27/Feb/2014
	 * @version Alpha
	 * Project J&J ProyeccionEscolar
	 * In this project we are going to make a Online Qualifications Systems for some school 
	 * trying to cover the most important task that concerns teachers, admins and students
	 * the URL for the index.php is (when we _POST['accion'] the web page up in the server) 
	 * www.proyeccionescolar.co.nf/index.php?usuario='alumno'&accion='alta' 
	 * 
	 * @param usuario This describes to where the controller is passed to, there are 3 users 'alumno' 'maestro' 'admin'
	 * @param accion This describes what action is taking depends on each user
	 * if theres no valid user or actions, appears a error message
	 */
	 //$_POST['accion']['ctrl']='alumno';
	 /*
	 $_POST['accion']['usuario'] ='alumno';
	 $_POST['accion']['acccion']='listar';
	 $_POST['accion']['grupo']='CC001';
	 $_POST['accion']['ord']='1';
	 $_POST['accion']['nombre']='Jesus Alberto Ley Ayon';
	 $_POST['accion']['correo']='jesus_ayon@hotmail.com';
	 $_POST['accion']['codigo']='206587305';
	 $_POST['accion']['carrera']='01';
	 $_POST['accion']['url']='https://bewtenue.net/index.php';
	 $_POST['accion']['git']='bewtenue123';
	 $_POST['accion']['celular']='3313845969';
	 $_POST['accion']['equipo'] = 'J&J';
	 */
	 
	 if (!isset($_SESSION)){ //We ask first of the session 
		session_start();

		if(!isset($_SESSION['user']))
			require('Vista\login.html');
		else {
			require('Vista\index.html');
		}

	 }
	 
	  if(isset($_GET['usuario'])){//Check if in POST exists the user
		if(preg_match("/[A-Za-z]+/",$_GET['usuario'])){ // The string must be alphabetic
			switch($_GET['usuario']){
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
				default: //The user still need to login, we can't do anything if he / she is not logged
					header('Location: Vista/login.html');
					break;
			}
			//if(isset($ctrlAlumno))
			if(isset($controlador))
				//$ctrlAlumno->ejecutar();
				$controlador->ejecutar();
		}
		else{
			header('Location: Vista/login.html');
		}
	  }
	  else{
			header('Location: Vista/login.html');
	  }
?>
