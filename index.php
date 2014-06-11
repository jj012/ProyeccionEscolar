<?php
	/**
	 * @author: J. Rizo Orozco & Jesus Alberto Ley Ayón & Jorge Eduardo Garza
	 * @since: 27/Feb/2014
	 * @version 1.5
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
	 
	if (!isset($_SESSION)) {
		session_start();
<<<<<<< HEAD

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
=======
	} else {
		if (isset($_SESSION['user']) && isset($_SESSION['tipo'])) {
			switch($_SESSION['tipo']) {
				case 1 :
					require_once ('VISTAS/COMUNES/indexAdministrador.htlm');
>>>>>>> origin/master
					break;
	
				case 2 :
					require_once ('VISTAS/COMUNES/indexMaestro.htlm');
					break;
	
				case 3 :
					require_once ('VISTAS/COMUNES/indexAlumnohtlm');
					break;
			}
	
			if (isset($_GET['ctrl']) && preg_match("/[A-Za-z]+/", $_GET['usuario'])) {
				$controlador = $_GET['ctrl'] . 'Ctrl';
	
				if (file_exists("ctrls/{$controlador}.php")) {
					require_once ("ctrls/{$controlador}.php");
					$ctrl = new $controlador();
	
				} else {
					$error = "{$_GET['ctrl']} no es un controlador valido";
					require_once ('VISTAS/ERRORES/opcionInvalida.html');
				}
	
			} else {
				//ctrl default
				require_once ('ctrls/alumnosCtrl.php');
				$ctrl = new alumnosCtrl();
			}
		} else {
			require_once ("VISTAS/FORMULARIOS/login.html");
		}
	}
?>
