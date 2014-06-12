<?php
	class Ciclo{
		private $id;
		private $ciclo;
		private $inicio;
		private $fin;
		
		public function setId($id){
			this.$id=$id;
		}
		
		public function setCiclo($ciclo){
			this.$ciclo=$ciclo;
		}
		
		public function setInicio($inicio){
			this.$inicio=$inicio;
		}
		
		public function setFin($fin){
			this.$fin=$fin;
		}
		
		public function getId(){
			return $id;	
		}
		
		public function getCiclo(){
			return $ciclo;
		}
		
		public function getInicio(){
			return $inicio;
		}
		
		public function getFin(){
			return $fin;
		}
	}
?>