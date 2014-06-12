<?php
	class Horario{
		protected $idHorario;
		protected $dia;
		protected $entrada;
		protected $salida;
		
		public function getIdHorario(){
			return $this->idHorario;
		}
		
		public function getDia(){
			return $this->dia;
		}
		
		public function getEntrada(){
			return $this->entrada;
		}
		
		public function getSalida(){
			return $this->salida;
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