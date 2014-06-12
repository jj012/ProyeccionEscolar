<?php
	require_once('Usuario.php');
	class Alumno extends Usuario{
		private $idAlumno;
		private	$carrera;
		private $celular;
		private $github;
		private $web;
		
		public function setIdAlumno($idAlumno){
			$this->idAlumno=$idAlumno;
		}
		
		public function setCarrera($carrera){
			$this->carrera=$carrera;
		}
		
		public function setCelular($celular){
			$this->celular=$celular;
		}
		
		public function setGit($github){
			$this->github=$github;
		}
		
		public function setWeb($web){
			$this->web=$web;
		}
		
		public function getIdAlumno(){
			return $idAlumno;
		}
		
		public function getCarrera(){
			return $carrera;
		}
		
		public function getCelular(){
			return $celular;
		}
		
		public function getGit(){
			return $github;
		}
		
		public function getWeb(){
			return $web;
		}
	}
?>