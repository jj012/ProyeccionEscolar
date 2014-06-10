<?php
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
		
		public function validaRubro($rubro){
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $rubro))
				return true;
			else 
				return -1;
		}
		public function validaHoras($horas){//function to validate the hours of the class from 1 to 4
			if(preg_match("/[1-4]/",$horas))
				return true;
			else
				return -1;
		}
		public function validaHorario($horario){//function to validate the schedule of the class
			if(preg_match("/[0-2][0-9]{3}/",$horario))
				return true;
			else
				return -1;
		}
		
		public function validaActividad($actividad){//function to validate the activity of evaluation
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $actividad))
				return true;
			else 
				return -1;
		}
		public function validaPorcentaje($porcentaje){//function to validate the percentage of the activity
			if (preg_match("/(100)|[0-9]{2}/", $porcentaje))
				return true;
			else 
				return -1;
		}
		public function validaCalificacion($calificacion){//function to validate the qualification 0-10 and 1 decimal also accepts SD and NP
			if(preg_match("/10|([0-9][.][0-9]{1})|SD|NP/",$calificacion))
				return true;
			else 
				return -1;
		}
	}
?>