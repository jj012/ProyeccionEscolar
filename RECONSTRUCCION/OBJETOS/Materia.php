<?php
	class Materia{
		private $id;
		private $nombre;
		private $clave;
		private $nombreAcademia;
		
		public function getId(){
			return $id;
		}
		
		public function getNombre(){
			return $nombre;
		}
		
		public function getClave(){
			return $clave;
		}
		
		public function getAcademia(){
			return $nombreAcademia;	
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