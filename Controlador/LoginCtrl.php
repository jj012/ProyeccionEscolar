<?php
	/**
	* @author Javier Rizo Orozco
	* Controller of Login to verify the data and start with a session
	**/
	
	require_once("CtrlEstandar.php");
	
	class LoginCtrl extends CtrlEstandar{
		public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/LoginMdl.php');
			$this->model = new LoginModel();
		}
		
		//Search which action take to do it.
			function ejecutar(){//This is where run the session
			if(isset($_POST['accionL']) && preg_match("/[A-Za-z]+/", $_POST['accionL']))
				switch($_POST['accionL']){
				case 'login':
				if(!$this->isLogged()){
					if(isset($_POST['user']))
						$codigo = $this->validaCodigo($_POST['user']);
					else
						$codigo= false;
					if(isset($_POST['pass']))
						$p = $this->validaPass($_POST['pass']);
					else
						$p = false;
					if($p && $codigo){
						$arreglo = $this->limpiaSQL(array($_POST['user']));
						$codigo = $arreglo[0];
						//$p = crypt($_POST['pass']);//We use a hash to encrypt the password
						if($this->login($codigo, $p)){
							if($this->esMaestro()){
								if(isset($_POST['accion']))
									header("Location: index.php?usuario=maestro&accion={$_POST['accion']}");
							}
							else if($this->esAlumno()){
								if(isset($_POST['accion']))
									header("Location: index.php?usuario=alumno&accion={$_POST['accion']}");
							}
							else if($this->esAdmin()){
								if(isset($_POST['accion']))
									header("Location: index.php?usuario=admin&accion={$_POST['accion']}");
							}
							else{
								include('Vista/erroresLogueo.php');
								faltaAccion();
							}
						}
					}
					else{
						include('Vista/erroresLogueo.php');
						erroresLogueo($p, $codigo);
					}
					break;
				}
				else{
					include('Vista/erroresLogueo.php');
					noLogueado();
					header("Location: index.php?");
				}
				break;
				
				case 'logout':
				if($this->isLogged()){
					$this->logout();
				}
				else{
					include('Vista/erroresLogueo.php');
					noLogueado();
					header("Location: index.php?");
				}
				break;
				}
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
		include("Vista/cambioPass.php");
		ingreseNuevo();
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
					exitoCambio();
		    }
			  else
					sinCambio();
			}
			else
				noIguales();
		}
		else
			noValidas();
	}
	
	function isLogged(){//We verify the user is in the 
		if(isset($_SESSION['user']))
			return true;
		else
			return false;
	}
	
	function login($id, $cont){
		$exito = $this->model->connect(array($id, $cont));
		if(!$exito['resultado'])
			return false;
			
		$_SESSION['user'] = $id;
		$_SESSION['tipo'] = $exito['tipo'];
		$_SESSION['nombre'] = $exito['nombre'];
		
		return true;
	}
	
	function logout(){//Destroy the session
		session_unset();
		session_destroy();
		setcookie(session_name(), '', time() - 3600);
	}

	
	public function validaPass($p){ //Function to validate the pass with a lenght of 6-20 characters
		if(preg_match("/^[A-Za-z0-9_\-]{6,20}/", $p))
			return true;
		else
			return -1;
	}

}
?>
