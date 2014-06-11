
﻿<?php
	class Verificador{
		
		public function validaCalificaciones($calificaciones){

			foreach($calificaciones as $calificacion){
				if($this->validaCalificacion($calificacion) === -1)
					return -1;
			}
			return true;
		}
		
		public function validaColumnas($columnas){
			if(preg_match("/[1-9]{1,2}/",$columnas))
				return true;
			else 
				return -1;

		}
		
		
		public function validaNombreCurso($nombrecurso){ //here we validate the syntaxis of the name of the course 
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $nombrecurso))
				return true;
			else 
				return -1;
		}
		public function validaSeccion($seccion){//function to validate the name of the section
			if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$seccion))
				return true;
			else
				return -1;
		}
		public function validaNrc($nrc){//function to validate the nrc of the especific group
			if(preg_match("/0[0-9]{4}/",$nrc))
				return true;
			else 
				return -1;
		}
		public function validaAcademia($academia){//function to validate the syntaxis of the name of the academy
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $academia))
				return true;
			else 
				return -1;
		}
		public function validaDias($dias){//function to validate the days of the class
			if(preg_match("/[1-6]/",$dias))
				return true;
			else 

				return -1;
		}


	public function validaRubro($rubro) {
		if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $rubro))
			return true;
		else
			return -1;
	}

	public function validaHoras($horas) {//function to validate the hours of the class from 1 to 4
		if (preg_match("/[1-4]/", $horas))
			return true;
		else
			return -1;
	}

	public function validaHorario($horario) {//function to validate the schedule of the class
		if (preg_match("/[0-2][0-9]{3}/", $horario))
			return true;
		else
			return -1;
	}

	public function validaActividad($actividad) {//function to validate the activity of evaluation
		if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $actividad))
			return true;
		else
			return -1;
	}

	public function validaPorcentaje($porcentaje) {//function to validate the percentage of the activity
		if (preg_match("/(100)|[0-9]{2}/", $porcentaje))
			return true;
		else
			return -1;
	}

	public function validaCalificacion($calificacion) {//function to validate the qualification 0-10 and 1 decimal also accepts SD and NP
		if (preg_match("/10|([0-9][.][0-9]{1})|SD|NP/", $calificacion))
			return true;
		else
			return -1;
	}
	
	public function validaNombre($cadena){ //Function to validate the syntax of name

		$cadena = ltrim($cadena);
		$cadena = rtrim($cadena);//We clean the name first
		if(preg_match("/^[A-Za-z\sñÑáéíóúâêîôûàèìòùäëïöü]+/", $cadena)){
			return true;
		}
		else
			return -1;
		}
	
	public function validaCorreo($correo){//Function to validate the syntax of email
		$correo = ltrim($correo);
		$correo = rtrim($correo);//We clean the email first
		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $correo))
			return true;
		else
			return -1;
	}
	
	function validaCodigo($codigo) {//Function to validate the code with a lenght of 9 numbers
		$codigo = ltrim($codigo);
		$codigo = rtrim($codigo);
		//We clean the code first
		if (preg_match("/^[A-Za-z]?[0-9]{6,9}/", $codigo)) {
			return true;
		} else
			return -1;
	}
	
	public function validaCarrera($carrera){//Function to validate the career with a number of one or two digits
		$carrera = ltrim($carrera);
		$carrera = rtrim($carrera);//We clean the career first
		if(preg_match("/[0-9]{1,2}/", $carrera))
			return true;
		else
			return -1;
	}
	public function validaURL($url){//Function to validate the url if is corrrect or dont (This function it isnt oblirate
		$url = ltrim($url);
		$url = rtrim($url);//We clean the url first
		if(preg_match("/^((http|https):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $url))
			return true;
		else
			return -1;//If there dont url that means false, but if there an url and its bad then the insertion it gonna be bad.
	}
	
	public function validaGitHub($git){//Function to validate the acoount of Github
		$git = ltrim($git);
		$git = rtrim($git);//We clean the account of git first
		if(preg_match("/^[A-Za-z\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $git))
			return true;
		else
			return -1; //If there dont git that means false, but if there an git and its bad then the insertion it gonna be bad.
	}
	
	public function validaCelular($numero){//Function to validate the syntax of the number of cellphone
		$numero = ltrim($numero);
		$numero = rtrim($numero);//We clean the number first
		if(preg_match("/^(1-9)[0-9]{7}+/", $numero))//It's 7 because we need the first number is great of 0
			return true;
		else
			return -1;//If there dont cellphone number that means false, but if there a number and its bad then the insertion it gonna be bad.
	}
	
	public function validaEquipo($equipo){//Function to validate the name of tean, a team can been an alphabeticnumber
		$equipo = ltrim($equipo);
		$equipo = rtrim($equipo);//We clean the name first
		if(preg_match("/^[A-Za-z0-9\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $equipo))
			return true;
		else
			return -1;//If there dont team that means false, but if there a team and its bad then the insertion it gonna be bad.
	}

	public function verificaExistencia($datosObligados){//On this function we return true if the requiremnts are there, if dont we return false
		if($datosObligados['nombre'] === true && $datosObligados['correo'] === true && $datosObligados['carrera'] === true && $datosObligados['codigo'] === true
		   && $datosObligados['contraseña'] === true){
			return true;
		}
		else
			return false;
	}
	
	public function opcionalesCorrectos($datosOpcionales){// We ask if there any data and its correct, if doesnt correct then we give an error
		if($datosOpcionales['url'] !== -1 && $datosOpcionales['git'] !== -1 && $datosOpcionales['celular'] !== -1) 
			return true;
		else
			return false;
	}//The data is not obligatored but if is there and it's bad then we need to give an error
	
	public function verificaGrupo($grupo){// We return true if the group is correct
		if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$grupo))
			return true;
		else
			return false;
	}

	
	public function validaPassword($password){ // this function validates any character as a password with a lenght between 8 and 50 characters
		if(preg_match("/.{8,50}/"))
		return true;
		else 
			return false;
	}

	function esMaestro() {//Function to verify that the user is a teacher
		if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'maestro')
			return true;
		else
			return false;
	}

	function esAlumno() {//Function to verify that the user is a teacher
		if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'alumno')
			return true;
		else
			return false;
	}

	function esAdmin() {//Function to verify that the user is a teacher
		if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin')
			return true;
		else
			return false;
	}


	public function validaFecha($fecha) {//Function to validate the date
		$fecha = $this -> limpiaDato($fecha);
		$expresion = "/([123]0|[012][1-9]|31)\/(0[1-9]|1[012])\/(19[0-9]{2}|2[0-9]{3})/";
		if (preg_match($expresion, $fecha))
			return true;
		else
			return -1;
	}

	public function validaGrupoFecha($fechas) {//Same function but to validate more dates
		foreach ($fechas as $fecha) {
			if ($this -> validaFecha($fecha) === -1) {
				return -1;
			}
		}
		return true;
	}

	public function verificaRangoFechas($fechasCiclo) {
		$fechaInicio = DateTime::createFromFormat('d/m/Y', $fechasCiclo['fechaInicial']);
		$fechaFin = DateTime::createFromFormat('d/m/Y', $fechaCiclo['fechaFin']);
		$fechaActual = new DateTime("NOW");
		if (isset($fechasCiclo['festivos'])) {
			$asuetos = $fechasCiclo['festivos'];
			$asuestosFormato = array();
			foreach ($asuetos as $dia); {
				$asuetosFormato[] = DateTime::createFromFormat('d/m/Y', $dia);
			}
		}

		$validacion = array(0 => false);
		if ($fechaInicio > $fechaFin) {
			$validacion[1] = "inicioMayor";
		} else if ($fechaActual > $fechaInicio || $fechaActual > $fechaFin) {
			$validacion[1] = "fechasPasadas";
		} else if (isset($asuetosFormato)) {
			foreach ($asuetosFormato as $asueto) {
				if ($asueto < $fechaInicio) {
					$validacion[1] = "festivosFueraRango";
					break;
				}
			}
		} else {
			$validacion[0] = true;
		}
		return $validacion;
	}
	
	public function validaPass($p){ //Function to validate the pass with a lenght of 6-20 characters
		if(preg_match("/^[A-Za-z0-9_\-]{6,20}/", $p))
			return true;
		else
			return -1;
	}

}
?>