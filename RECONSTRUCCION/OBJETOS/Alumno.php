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
			return $this->idAlumno;
		}
		
		public function getCarrera(){
			return $this->carrera;
		}
		
		public function getCelular(){
			return $this->celular;
		}
		
		public function getGit(){
			return $this->github;
		}
		
		public function getWeb(){
			return $this->web;
		}
	}
?>