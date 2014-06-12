<?php
	class Usuario{
		protected $idUsuario;
		protected $nombre;
		protected $apellidop;
		protected $apellidom;
		protected $codigo;
		protected $contrasena;
		protected $correo;
		
		public function getId(){
			return $idUsuario;
		}
		
		public function getNombre(){
			return $nombre;
		}
		
		public function getApellidoP(){
			return $apellidop;
		}
		
		public function getApellidoM(){
			return $apellidom;
		}
		
		public function getCodigo(){
			return $codigo;
		}
		
		public function getContrasena(){
			return $contrasena;
		}
		
		public function getCorreo(){
			return $correo;
		}
		
		public function setId($idUsuario){
			$this->idUsuario=$idUsuario;
		}
		
		public function setNombre($nombre){
			$this->nnombre=$nombre;
		}
		
		public function setApellidoM($apellidom){
			$this->apellidom=$apellidom;
		}
		
		public function setApellidoP($apeliidop){
			$this->apellidop=$apellidop;
		}
		
		public function setCodigo($codigo){
			$this->codigo=$codigo;
		}
		
		public function setContrasena($contrasena){
			$this->contrasena=$contrasena;
		}
		
		public function setCorreo($correo){
			$this->correo=$correo;
		}
	}
?>