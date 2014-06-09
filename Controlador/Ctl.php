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
		protected $footer = file_get_contents("vista/footer.html");//variable que contiene footer
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
		
		function enviarmail()
		{
			$mail             = new PHPMailer(); // defaults to using php "mail()"
			 
			$body             = file_get_contents('contents.html');
			$body             = eregi_replace("[\]",'',$body);
			 
			$mail->AddReplyTo("name@yourdomain.com","First Last");
			 
			$mail->SetFrom('name@yourdomain.com', 'First Last');
			 
			$mail->AddReplyTo("name@yourdomain.com","First Last");
			 
			$address = "whoto@otherdomain.com";
			$mail->AddAddress($address, "John Doe");
			 
			$mail->Subject    = "PHPMailer Test Subject via mail(), basic";
			 
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			 
			$mail->MsgHTML($body);
			 
			$mail->AddAttachment("images/phpmailer.gif");      // attachment
			$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
			 
			if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			echo "Message sent!";
			}
						
		}
					
	}
?>