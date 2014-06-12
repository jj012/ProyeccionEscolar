<?php
	class Materia{
		private $id;
		private $nombre;
		private $clave;
		private $nombreAcademia;
		
		public function getId(){
			return $this->id;
		}
		
		public function getNombre(){
			return $this->nombre;
		}
		
		public function getClave(){
			return $this->clave;
		}
		
		public function getAcademia(){
			return $this->nombreAcademia;	
		}
		
		public function setId($id){
			$this->id=$id;
		}
		
		public function setNombre($nombre){
			$this->nombre=$nombre;
		}
		
		public function setClave($clave){
			$this->clave=$clave;
		}
		
		public function setAcademia($nombreAcademia){
			$this->nombreAcademia=$nombreAcademia;
		}
	}
?>