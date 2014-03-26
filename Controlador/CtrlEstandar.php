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
	
	
	abstract function ejecutar();


	
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

};