<?php
	/**
	* @author Javier Rizo Orozco
	* Controller of Login to verify the data and start with a session
	**/
	class LoginCtrl{
		public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/LoginMdl.php');
			$this->model = new LoginModel();
		}
		
		//Search which action take to do it.
		public function ejecutar(){
			if(isset($_POST['accion'])){
				if(preg_match("/[A-Za-z]+/", $_POST['accion'])){ //Validates the action is alphabetic
					switch($_POST['accion']){
					case 'logueo':
						if(isset($_POST['codigo']))
							$codigo = $this->validaCorreo($_POST['codigo']);
						else
							$codigo= false
						if(isset($_POST['pass']))
							$p = $this->validaPass($_POST['pass']);
						else
							$p = false;
							if($p && $codigo){
								$arreglo = limpiaSQL(array($_POST['codigo']));
								$codigo = $arreglo[0];
								$p = crypt($_POST['pass']);//We use a hash to encrypt the password
								$exito = $this->model->connect(array($p, $codigo));
								if($exito){
									include('Vista/inicioSesion.php');
									saludo($codigo);
								}else{
									include('Vista/erroresLogueo.php');
									incorrecto();
								}
								
							
							}
							else{
								include('Vista/erroresLogueo.php');
								errorLogueo($p, $codigo);
							}
							break;
					case 'cambio':
						if(isset($_POST['codigo']))
							$codigo = $this->validaCodigo($_POST['codigo']);
						else
							$codigo= false
						if($codigo){
							$buscaCorreo = $this->model->connect(array(false, $_POST['codigo']));
							if($buscaCorreo){
								enviaCifrado($_POST['codigo']));
							}	
							else{
								echo "No se puede localizar el correo, por favor hable con el admin";
							}
						
						}
						break;
					}
				}
				else
					echo "Accion incorrecta </br>";
			}
			else
				echo "No existe accion a ejecutar </br>";
						
		}
	
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
		if(preg_match("/^[A-Za-z]?[0-9]{9}/", $codigo))
			return true;
		else
			return -1;
	}
	
	public function enviaCifrado($codigo){//We are suposed to think that the user acces to here by email
	  echo "Ingrese la contraseña y una nueva contraseña </br>";
		if(isset($_POST['pass1']))
			$p1 = $this->validaPass($_POST['pass1']);
		else
			$p1 = false;
		if(isset($_POST['pass2']))
			$p2 = $this->validaPass($_POST['pass2']);
		else
			$p2 = false;
		if($p1 && p2){
			$p1 = $_POST['pass1'];
			$p2 = $_POST['pass2'];
			if(strcmp($p1, $p2) == 0){ //Password equal
			
				$exito = $this->model->modifica(array(crypt($p1), $codigo));
				if($exito){
					include("Vista/cambioPass.php");
		    }
			  else
					echo "No pudo cambiarse las contraseñas, intente de nuevo o hable con el admin </br>";
			}
			else
				echo "Las contraseñas no son iguales </br>";
		}
		else
			echo "Las contraseñas no son validas";
		
	
	
	}
	
	public function validaPass($p){ //Function to validate the pass with a lenght of 6-20 characters
		if(preg_match("/^[A-Za-z0-9_\-]{6,20}/", $p))
			return true;
		else
			return -1;
	}

}
?>
