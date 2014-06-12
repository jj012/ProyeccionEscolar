<?php
	class Horario{
		protected $idHorario;
		protected $dia;
		protected $entrada;
		protected $salida;
		
		public function getIdHorario(){
			return $idHorario;
		}
		
		public function getDia(){
			return $dia;
		}
		
		public function getEntrada(){
			return $entrada;
		}
		
		public function getSalida(){
			return $salida;
		}
		
		public function setIdHorario($idHorario){
			$this->idHorario=$idHorario;
		}
		
		public function setDia($dia){
			$this->dia=$dia;
		}
		
		public function setEntrada($entrada){
			$this->entrada=$entrada;
		}
		
		public function set($salida){
			$this->salida=$salida;
		}
	}
?>