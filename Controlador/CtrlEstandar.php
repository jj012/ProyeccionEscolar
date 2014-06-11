<?php
/**
 * @author: Javier Rizo Orozco y Jorge Eduardo Garza
 * @date: 18/03/2014
 * Class Standard to inherence the other classes.
 * @version:2
 * Methods to verify the user is logued or not
 **/
 
require_once ("Verificador.php");
abstract class CtrlEstandar {

	protected $model;
	protected $diccionarioEstandar;
	protected $verificador;

	function __construct() {
		$verificador = new Verificador;
	}

	abstract function ejecutar();
	abstract function alta();
	abstract function baja();
	abstract function modifica();
	abstract function consulta();
	abstract function procesaPlantilla();

	function isLogged() {
		//We verify the user is in the
		if (isset($_SESSION['user']))
			return true;
		else
			return false;
	}

	function limpiaSQL($variables) {//Posibility to use with the other controllers because is more standard this function
		foreach ($variables as $llave => $valor) {
			if (is_string($valor)) {
				$valor = ltrim($valor);
				$valor = rtrim($valor);
				$variables[$llave] = $valor;
			}
		}//Look this wonderful code :D we are gonna to use to another controllers to clean the values.

		return $variables;
	}

	function enviaCorreo($correo, $usuario, $msn) {

		require_once ('PHPMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail -> IsSMTP();
		$mail -> Host = "smtp.gmail.com";
		$mail -> SMTPAuth = true;
		$mail -> Port = 465;
		$mail -> CharSet = "UTF-8";
		$mail -> SMTPSecure = "ssl";
		$mail -> Username = "proyeccionescolarjj@gmail.com";
		$mail -> Password = "cuentautil";
		$mail -> SMTPDebug = 0;
		$mail -> Debugoutput = "html";

		$mensaje .= $msn;
		$mail -> From = "proyeccionescolarjj@gmail.com";
		$mail -> FromName = "Miguel Angel Ochoa";
		$mail -> AddAddress($correo, $usuario);
		//First a email, then a name
		$mail -> Subject = "Alta a Proyeccion Escolar";
		$mail -> Body = $mensaje;
		$mail -> AltBody = "Alta";
		$mial -> IsHTML = (true);

		if ($mail -> Send()) {
			echo "Mensaje enviado correctamente. ";

		} else {
			echo "Ocurrio un error al enviar el correo electronico. ";
			echo "</br> <strong> Informacion: </strong><br/>" . $mail -> ErrorInfo;

		}
	}

	
	protected function validaCorreo($correo){//Function to validate the syntax of email
		$correo = ltrim($correo);
		$correo = rtrim($correo);//We clean the email first
		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $correo))
			return true;
		else
			return -1;
	}



}


?>

