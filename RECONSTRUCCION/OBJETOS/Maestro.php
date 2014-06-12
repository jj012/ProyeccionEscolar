<?php
	require_once('Usuario.php');
	class Maestro extends Usuario{
		private $idMaestro;
		
		public function getIdMaestro(){
			return $this->idMaestro;
		}
		
		public function set($idMaestro){
			$this->idMaestro=$idMaestro;
		}
	}
?>