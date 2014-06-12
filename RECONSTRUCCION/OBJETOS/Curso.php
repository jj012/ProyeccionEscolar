<?php

	class Curso{
		private $idCurso;
		private $seccion;
		private $nrc;
		private $horario = array(); //guarddar objetos tipo horario
		private $ciclo; // guardar objeto tipo ciclo
		private $materia; //guardar objeto materia
		private $profesor; //guardar objeto profesor

		
		public function getIdCurso(){
			return $idCurso;
		}
		
		public function getSeccion(){
			return $seccion;
		}

		public function getNRC(){
			return $nrc;
		}

		public function setIdCurso($idCurso){
			if(empty($idCurso)){
				echo 'nrc vacio error';
			}else{
				this.$idCurso=$idCurso;
			}
		}
		
		public function setSeccion($seccion){
			if(empty($seccion)){
				echo 'seccion vacio error';
			}else{
				this.$seccion=$seccion;
			}
		}

		public function setNRC($nrc){
			if(empty($nrc)){
				echo 'nrc vacio error';
			}else{
				this.$nrc=$nrc;
			}
		}
	}
	
?>