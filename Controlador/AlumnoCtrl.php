<?php
	/**
	* @author Javier Rizo Orozco
	* Controller of Alumno to verify which action take it.
	**/
	class AlumnoCtrl{
		public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/AlumnoMdl.php');
			$this->model = new AlumnoModel();
		}
		
		//Search which action take to do it.
		public function ejecutar(){
			if(isset($_POST['accion'])){
				if(preg_match("/[A-Za-z]+/", $_POST['accion'])){ //Validates the action is alphabetic
					switch($_POST['accion']){
						case 'alta':
						if(isset($_POST['nombre']))
							$nombre = $this->validaNombre($_POST['nombre']);
						else
							$nombre = false;
						if(isset($_POST['correo']))
							$correo = $this->validaCorreo($_POST['correo']);
						else
							$correo = false;
						if(isset($_POST['codigo']))
							$codigo = $this->validaCodigo($_POST['codigo']);
						else
							$codigo = false;
						
						if(isset($_POST['carrera']))
							$carrera = $this->validaCarrera($_POST['carrera']);
						else
							$carrera = false;
						if(isset($_POST['url']))
							$url = $this->validaURL($_POST['url']);
						else
							$url = false;
						if(isset($_POST['git']))
							$git = $this->validaGitHub($_POST['git']);
						else
							$git = false;
						if(isset($_POST['celular']))
							$url = $this->validaURL($_POST['celular']);
						else
							$url = false;
					
						$status = $this->verificaExistencia(array('nombre' => $nombre, 'correo' => $correo, 'carrera' => $carrera, 'codigo' => $codigo)); //We verify that the info exists
						if($status){//To enter this block first the info need to be correct
							$status = $this->opcionalesCorrectos(array('url' => $url, 'git' => $git, 'celular' => $celular, 'equipo' => $equipo));
							if($status){
								$datosAlumno = array('nombre'=>$nombre, 'correo'=> $correo, 'carrera' => $carrera, 'codigo' => $codigo, 'url' => $url, 'git'=> $git, 'celular' => $celular);
								$this->limpiaSQL($datosAlumno);
								$status = $this->model->insertaAlumno($datosAlumno);
								if($status){//On this part the query of insert in the database is done correctly
									include('Vista/insercionAlumno.php');
								
								}
								else{//On this part the query cannot be done of insert
									include('Vista/erroresAlumno.php');
									falloInsercion();
								}
							}
							else{
								include('Vista/erroresAlumno.php');
								falloOpcionales(array('url' => $url, 'git' => $git, 'celular' => $celular, 'equipo' => $equipo));
							}
						}
						else{
							include('Vista/erroresAlumno.php');
							erroresAlta(array('nombre' => $nombre, 'correo'=> $correo, 'carrera' => $carrera, 'codigo' => $codigo));
						}
						
						break;
						case 'listar':
						//Check if there a group
						if(isset($_POST['grupo'])){
							$grupoCorrecto = $this->verificaGrupo($_POST['grupo']);
							if($grupoCorrecto){
								
								$grupo = $this->model->listar($_POST['grupo']);
								if($grupo['status']){
									include('Vista/listadoAlumno.php');
									unset($grupo['status']);
									if(isset($_POST['ordena']) && $_POST['ordena']==1)
										sort($grupo);
									lista($grupo);
								}
								else
									echo "No existe el grupo que consultaste :( </br> "; //No se encontro el grupo
							}
							else
								echo "Este grupo no es correcto";
						}
						else
							echo "Como quieres que muestre un grupo sino me dices cual :/ </br>"; //No mando nada
						break;
					}
				}
				else
					echo "Accion no valida";
			
			}
			else
				echo "No se que quieres que haga :/ </br>";
	}
	
	public function validaNombre($cadena){ //Function to validate the syntax of name
		return preg_match("/^[A-Za-z\s\ \'\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC]+/", $cadena);
	}
	
	public function validaCorreo($correo){//Function to validate the syntax of email
			return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $correo);
	}
	
	public function validaCodigo($codigo){ //Function to validate the code with a lenght of 9 numbers
		return preg_match("/^[A-Za-z]?[0-9]{9}/", $codigo);
	}
	
	public function validaCarrera($carrera){//Function to validate the career start with Licenciatura or Ingenieria en with the name of career
		return preg_match("/[0-9]{2}/", $carrera);
	}
	public function validaURL($url){//Function to validate the url if is corrrect or dont (This function it isnt oblirate
		if(preg_match("/^([http|https]?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $url))
			return true;
		else
			return -1;//If there dont url that means false, but if there an url and its bad then the insertion it gonna be bad.
	}
	
	public function validaGitHub($git){//Function to validate the acoount of Github
		if(preg_match("/^[A-Za-z\ \'\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC]+/", $git))
			return true;
		else
			return -1; //If there dont git that means false, but if there an git and its bad then the insertion it gonna be bad.
	}
	
	public function validaCelular($numero){//Function to validate the syntax of the number of cellphone
		if(preg_match("/^(1-9)[0-9]{7}+/", $numero))//It's 7 because we need the first number is great of 0
			return true;
		else
			return -1;//If there dont cellphone number that means false, but if there a number and its bad then the insertion it gonna be bad.
	}
	
	public function validaEquipo($equipo){//Function to validate the name of tean, a team can been an alphabeticnumber
		if(preg_match("/^[A-Za-z0-9\ \'\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC]+/", $equipo))
			return true;
		else
			return -1;//If there dont team that means false, but if there a team and its bad then the insertion it gonna be bad.
	}
	
	public function verificaExistencia($datosObligados){//On this function we return true if the requiremnts are there, if dont we return false
		if($datosObligados['nombre'] !== false && $datosObligados['correo'] !== false && $datosObligados['carrera'] !== false  && $datosObligados['codigo'] !== false){
			return true;
		}
		else
			return false;
	}
	
	public function opcionalesCorrectos($datosOpcionales){// We ask if there any data and its correct, if doesnt correct then we give an error
		if($datosOpcionales['url'] !== -1 && $datosOpcionales['git'] !== -1 && $datosOpcionales['celular'] !== -1 && $datosOpcionañes['equipo']) 
			return true;
		else
			return false;
	}
	
	public function verificaGrupo($grupo){
		if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$grupo))
			return true;
		else
			return false;
	}
	
	public function limpiaSQL($datos){//We are gonna clear the string of commands like INSERT, TABLES, DELETE, ETC before we give to the database
		$inserta = '/([I|i][N|n][S|s][E|e][R|r][T|t])/';
		$tablas = '/([T|t][A|a][
	}
}
?>