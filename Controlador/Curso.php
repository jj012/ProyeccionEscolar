<?php

	class Curso{
		private $nombreCurso;
		private $seccion;
		private $nrc;
		private $academia;
		private $dias;
		private $horas;
		private $horario;
		private $ciclo;

		public function getNombre(){
			return $nombreCurso;
		}

		public function getSeccion(){
			return $seccion;
		}

		public function getNRC(){
			return $nrc;
		}

		public function getAcademia(){
			return $academia;
		}

		public function getDias(){
			return $dias;
		}

		public function getHoras(){
			return $horas;
		}

		public function getHorario(){
			return $horario;
		}

		public function getCiclo(){
			return $ciclo;
		}

		public function setNombre($nombre){
			if(empty($nombre)){
				echo 'nombre vacio error';
			}else{
				this->$nombre=$nombre;
			}
			
		}

		public function setSeccion($seccion){
			if(empty($seccion)){
				echo 'seccion vacio error';
			}else{
				this->$seccion=$seccion;
			}
		}

		public function setNRC($nrc){
			if(empty($nrc)){
				echo 'nrc vacio error';
			}else{
				this->$nrc=$nrc;
			}
		}

		public function setAcademia($academia){
			if(empty($academia)){
				echo 'academia vacio error';
			}else{
				this->$academia=$academia;
			}
		}

		public function setDias($dias){
			if(empty($dias)){
				echo 'dias vacio error';
			}else{
				this->$dias=$dias;
			}
		}

		public function setHoras($horas){
			if(empty($horas)){
				echo "horas vacia error";
			}else{
				this->$horas=$horas;
			}
		}

		public function setHorario($horario){
			if(empty($horario)){
				echo "horario vacio error";
			}else{
				this->$horario=$horario;
			}
		}

		public function setCiclo($ciclo){
			if(empty($ciclo)){
				echo "ciclo vacio error";
			}else{
				this->$ciclo=$ciclo;
			}
		}
	}
	
?>