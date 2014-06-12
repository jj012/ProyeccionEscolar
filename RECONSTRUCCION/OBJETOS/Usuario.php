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
			return $this->idUsuario;
		}
		
		public function getNombre(){
			return $this->nombre;
		}
		
		public function getApellidoP(){
			return $this->apellidop;
		}
		
		public function getApellidoM(){
			return $this->apellidom;
		}
		
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function getContrasena(){
			return $this->contrasena;
		}
		
		public function getCorreo(){
			return $this->correo;
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