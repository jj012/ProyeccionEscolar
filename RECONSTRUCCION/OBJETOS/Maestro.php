<?php
	require_once('Usuario.php');
	class Maestro extends Usuario{
		private $idMaestro;
		
		public function getIdMaestro(){
			return $idMaestro;
		}
		
		public function set($idMaestro){
			$this->idMaestro=$idMaestro;
		}
	}
?>