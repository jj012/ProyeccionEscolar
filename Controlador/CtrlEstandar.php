<?php
/**
  * @author: Javier Rizo Orozco
  * @date: 18/03/2014
  * Class Standard to inherence the other classes.
  * @version:1
  * Methods to verify the user is logued or not
**/


abstract class CtrlEstandar{

	private $model;

	function __construct(){
	}
	
	function isLogged(){//We verify the user is in the 
		if(isset($_SESSION['user']))
			return true;
		else
			return false;
	}
	
	
	abstract function ejecutar();
	abstract function alta();
	abstract function baja();
	abstract function modifica();
	abstract function consulta();

	public function limpiaSQL($variables){//Posibility to use with the other controllers because is more standard this function
		foreach($variables as $llave => $valor){
			if(is_string($valor)){
				$valor = ltrim($valor);
				$valor = rtrim($valor);
				$variables[$llave] = $valor;
			}
		}//Look this wonderful code :D we are gonna to use to another controllers to clean the values.
		
		return $variables;
	}
	
	function enviaCorreo($correo, $usuario){

		require_once('PHPMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Port = 465;
		$mail->CharSet = "UTF-8";
		$mail->SMTPSecure = "ssl";
		$mail->Username = "proyeccionescolarjj@gmail.com";
		$mail->Password = "cuentautil";
		$mail->SMTPDebug = 0;
		$mail->Debugoutput ="html";

		$mensaje = "<p>Saludos ".{$usuario}." </p> <p> Bienvenido al Sistema de Proyeccion Escolar </p>";
		$mensaje .= "<p>Para comenzar le recomendamos verificar que sus datos sean correctos entrando a su cuenta en nuestro sitio en la opcion de datos personales</p>";
		$mensaje .= "<p> Recuerde que estamos a sus ordenes y si surge un problema puede contactarme a  ochoadmin@hotmail.com </p>";
		$mensaje .= "<p> Esperamos que sea de su agrado el sitio </p>";
		$mail->From ="proyeccionescolarjj@gmail.com";
		$mail->FromName = "Miguel Angel Ochoa";
		$mail->AddAddress($correo, $usuario);//First a email, then a name
		$mail->Subject = "Alta a Proyeccion Escolar";
		$mail->Body = $mensaje;
		$mail->AltBody = "Alta";
		$mial->IsHTML = (true);

		if($mail->Send()){
			echo "Mensaje enviado correctamente. ";

		}else{
			echo "Ocurrio un error al enviar el correo electronico. ";
			echo "</br> <strong> Informacion: </strong><br/>".$mail->ErrorInfo;

		}
	}
	

	public function validaCodigo($codigo){ //Function to validate the code with a lenght of 9 numbers
		$codigo = ltrim($codigo);
		$codigo = rtrim($codigo);//We clean the code first
		if(preg_match("/^[A-Za-z]?[0-9]{6,9}/", $codigo)){
			return true;
		}
		else
			return -1;
	}
	
	function esMaestro(){//Function to verify that the user is a teacher
		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'maestro')
			return true;
		else
			return false;
	}
	
	function esAlumno(){//Function to verify that the user is a teacher
		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'alumno')
			return true;
		else
			return false;
	}
	
	function esAdmin(){//Function to verify that the user is a teacher
		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin')
			return true;
		else
			return false;
	}
	
	

	public function validaPass($p){ //Function to validate the pass with a lenght of 6-20 characters
		if(preg_match("/^[A-Za-z0-9_\-]{6,20}/", $p))
			return true;
		else
			return -1;
	}
	
	public function validaNombre($cadena){ //Function to validate the syntax of name

		$cadena = ltrim($cadena);
		$cadena = rtrim($cadena);//We clean the name first
		if(preg_match("/^[A-Za-z\sñÑáéíóúâêîôûàèìòùäëïöü]+/", $cadena)){
			return true;
		}
		else
			return -1;
	}
	
	public function validaCorreo($correo){//Function to validate the syntax of email
		$correo = ltrim($correo);
		$correo = rtrim($correo);//We clean the email first
		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $correo))
			return true;
		else
			return -1;
	}
	
	public function procesaPlantilla($ruta_contenido, $diccionario){
			
		
		$encabezado = file_get_contents('ruta_archivo');
		$cuerpo = file_get_contents('ruta_archivo');
		$pie = file_get_contents('ruta_archivo');
		
		$vista = $encabezado . $cuerpo . $pie;
		
		$diccionario = array(
			'{{nombre}}' => $_SESSION['usuario'],
			'{{materia}}' => $alumno->materia
			);
			
		$vista = strtr ($vista, $diccionario);
		
		echo $vista;

	}

};