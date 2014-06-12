<?php
	require_once('Usuario.php');
	class Administrador extends Usuario{
		private $idAdministrador;
		
		public function setIdAdministrador($idAdministrador){
			$this->idAdministrador=$idAdministrador;
		}
		
		public function get(){
			return $idAdministrador;
		}
	}
?>