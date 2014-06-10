<?php
	/**
	* @author Javier Rizo Orozco
	* Controller of Login to verify the data and start with a session
	* ACTIONS
	* login
	* logout
	* cambioContraseña
	**/
	
	require_once("CtrlEstandar.php");
	
	class LoginCtrl extends CtrlEstandar{
		public $model;
		
		public function __construct(){//Charge the model Alumno
			$verificador = new Verificador;
			require('Modelo/LoginMdl.php');
			$this->model = new LoginModel();
		}
		
		//Search which action take to do it.
		function ejecutar(){//This is where run the session
			if(isset($_GET['accion']) && preg_match("/[A-Za-z]+/", $_GET['accion'])){
				switch($_GET['accion']){
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
								if($this->login($codigo, $_POST['pass'])){
									if($this->esAlumno())
										header('Location: Vista/MenuAlumno.html');
									incorrecto();//Data incorrect
								}
								else{
									include('Vista/erroresLogueo.php');
									incorrecto();//Data incorrect
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
							header("Location: index.php");
						}
					break;
					
					case 'logout':
						if($this->isLogged()){
							$this->logout();
						}
						else{
							include('Vista/erroresLogueo.php');
							noLogueado();
							header("Location: index.php");
						}
					break;
					
					case 'cambioContraseña':
						if($this->isLogged()){
							$this->modificaPass();
						}else{
							include('Vista/erroresLogueo.php');
							noLogueado();
							header("Location: index.php");
						}
					break;
				}
			}
		}
	
	public function alta(){}
	public function baja(){}
	public function modifica(){}
	public function consulta(){}
	
	public function modificaPass(){
		if($this->esAdmin()){
			if(isset($_POST['codigo']))
				$codigo = $this->validaCodigo($_POST['codigo']);
			else
				$codigo = false;
			if(isset($_POST['contraseña']))
				$contraseña = $this->validaPass($_POST['contraseña']);
			else
				$contraseña = false;
				
			if(isset($_POST['tipo'])){
				if($_POST['tipo'] == 1 || $_POST['tipo'] == 2 || $_POST['tipo'] == 3)
					$tipo = true;
				else
					$tipo = -1;
			}else{
				$tipo = false;
			} 
				
			if($codigo !== -1 && $codigo !== false && $contraseña !== -1 && $contraseña !== false && $tipo !== -1 && $tipo !== false)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = array('codigo' => $_POST['codigo'], 'contraseña' => $_POST['contraseña'], 'tipo' => $_POST['tipo']);
				$arreglo = $this->limpiaSQL($arreglo);
				
				$cambioPass = $this->model->modificaPass($arreglo);
				if($cambioPass[0]){
					include('Vista/cambioPass.php');
					exitoCambio();
				}else{
					include('Vista/erroresPass.php');
					errorContraseña($cambioPass[1]);
				
				}
			
			}else{
				$datos = array ('codigo' => $codigo, 'contraseña' => $contraseña, 'tipo' => $tipo);
				include('Vista/cambioPass.php');
				erroresCambioAdmin($datos);
			}
		}
		else if($this->esMaestro() || $this->esAlumno()){
			if(isset($_POST['contraseña']))
				$contraseña = $this->validaPass($_POST['contraseña']);
			else
				$contraseña = false;
				
			if($contraseña){
				$arreglo = array('contraseña' => $_POST['contraseña'], 'codigo' => $_SESSION['user']);
				if($this->esAlumno())
					$arreglo['tipo'] = '1';
				else if($this->esMaestro())
					$arreglo['tipo'] = '2';
					
				$arreglo = $this->limpiaSQL($arreglo);
				$cambioPass = $this->modificaPass($arreglo);
				if($cambioPass[0]){
					include('Vista/cambioPass.php');
					exitoCambio();
				}else{
					include('Vista/erroresPass.php');
					errorContraseña($cambioPass[1]);
				
				}
				
			}else if($contraseña === -1){
				include('Vista/cambioPass.php');
				noValidas();
			
			}else if(!contraseña){
				include('Vista/cambioPass.php');
				sinContraseña();
			}
		
		}else{
			include('Vista/erroresLogueo.php');
			faltaPermisos();
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

}
?>
