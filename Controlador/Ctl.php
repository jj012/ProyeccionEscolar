<?php
	/**
	*@author Garza Martinez Jorge Eduardo
	*@version 1.0.0
	*
	* esta clase esta pensada como abstracta ya que todos los controladores
	* que la heredaran la implementaran de manera diferente
	*/
	abstract class Ctls
	{
		protected $conexiondb;
		protected $valido = array();//esta variable almacenara todos los datos que sean validados por la funcion
		//validarEntradas();

		//variables necesarias para el procesamiento de palntillas
		protected $header = file_get_contents("vista/header.html");//variable que contiene header
		protected $footer = file_get_contents("vista/footer.html")//variable que contiene footer
		protected $contenido;
		

		//al ser todos los metodos abstractos se permite que las clases que la hereden implementen de diferente
		//manera la funcionalidad de acuerdo a sus necesidades
		abstract protected function alta();
		abstract protected function baja();
		abstract protected function consulta();
		abstract protected function modificacion();
		abstract protected function validarEntradas();
		abstract protected function procesarPlantilla($ruta_contenido,$diccionario);
		abstract public function ejecutar();

		function procesarPantilla($ruta_contenido,$diccionario){
			//cargar las secciones
			$encabezado = file_get_contents('ruta_archivo');
			$cuerpo = file_get_contents($ruta_contenido);
			$pie = file_get_contents('ruta_archivo');

			$vista = $encabezado.$cuerpo.$pie;
			//reemplaza contenido dinamico
			$vista = strtr($vista,$diccionario);

			//imprime la vista
			echo $vista;
		}
	}
?>