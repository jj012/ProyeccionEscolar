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
	
		function enviarmail(){
			// multiple recipients
			$to  = 'aidan@example.com' . ', '; // note the comma
			$to .= 'wez@example.com';
			
			// subject
			$subject = 'Birthday Reminders for August';
			
			// message
			$message = '
			<html>
			<head>
			  <title>Birthday Reminders for August</title>
			</head>
			<body>
			  <p>Here are the birthdays upcoming in August!</p>
			  <table>
			    <tr>
			      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
			    </tr>
			    <tr>
			      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
			    </tr>
			    <tr>
			      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
			    </tr>
			  </table>
			</body>
			</html>
			';
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
			$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
			$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
			
			// Mail it
			mail($to, $subject, $message, $headers);
						
		}



};