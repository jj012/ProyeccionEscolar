<?php
	/**
	* @author Javier Rizo Orozco
	* Controller of Alumno to verify which action take it.
	 * Possible cases 'alta','listar','consultar'
	 * 
	 * CASE ALTA 
	 * in the 'alta' action we get the data from the student,then we verify the data and then send it to the @see insertaAlumno(), if the 'alta' 
	 * was succesful then we show a view confirming it else we show an error 
	 * these are obligatory
	 * @param nombre the student name
	 * @param correo the student e-mail
	 * @param codigo the student code
	 * @param carrera the career of the student
	 * these are optional
	 * @param url the site of the student
	 * @param git the Git account of the student
	 * @param celular the student cel phone
	 * @param equipo the name of the student team
	 * 	www.proyeccionescolar.co.nf/index.php?usuario='alumno'&accion='alta'&nombre=''&correo=''&codigo=''&carrera=''&url=''&git=''&celular=''&equipo=''
	 * 
	 * CASE LISTAR
	 * in the 'listar' action we get the data of the group of the student verify it and send to @see listar(), if the group was founded returns an array
	 * with the info of the group else we show an error
	 * @param grupo the group for listing
	 * 
	 * 
	 * CASE CONSULTAR
	 * in the 'consultar' action we get the data code and password for a student and send it to @see consulta(), if the student was found returns 
	 * the student qualification else we show an error
	 * @param codigoconsulta the code for the query
	 * @param password the password of the student
	 * 
	 * 
	 * we also manage functions to validate data through regular expresions and a cleaning function for SQL they are documented down
	 * 
	 * public function limpiaSQL($variables) @param $variables you put the array you are going to clean
	
	public function validaNombre($cadena)
	
	public function validaCorreo($correo)
	
	public function validaCodigo($codigo)
	 
	public function validaCarrera($carrera)
	 
	public function validaURL($url)
	
	public function validaGitHub($git)
	
	public function validaCelular($numero)
	
	public function validaEquipo($equipo)
	
	public function verificaExistencia($datosObligados)
	
	public function opcionalesCorrectos($datosOpcionales)
	
	public function verificaGrupo($grupo)
		
	public function validaPassword($password)
	
	 * 
	**/
	require_once("CtrlEstandar.php");
	class AlumnoCtrl extends CtrlEstandar{
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
						if($this->isLogged() && $this->esMaestro()){
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
							if(isset($_POST['equipo']))
								$equipo = $this->validaEquipo($_POST['equipo']);
							else
								$equipo = false;
							if(isset($_POST['contraseña']))
								$contraseña = $this->validaPass($_POST['contraseña']);
							else
								$contraseña = false;
							
							$status = $this->verificaExistencia(array('nombre' => $nombre, 'correo' => $correo, 'carrera' => $carrera, 'codigo' => $codigo, 'contraseña' => $contraseña)); //We verify that the info exists
							if($status){//To enter this block first the info need to be correct
								$status = $this->opcionalesCorrectos(array('url' => $url, 'git' => $git, 'celular' => $celular, 'equipo' => $equipo));
								if($status){
									$datosAlumno = array('nombre'=>$nombre, 'correo'=> $correo, 'carrera' => $carrera, 'codigo' => $codigo, 'url' => $url, 'git'=> $git, 'celular' => $celular);
									$datosAlumno = $this->limpiaSQL($datosAlumno);
									$status = $this->model->insertaAlumno($datosAlumno);
									if($status[0]){//On this part the query of insert in the database is done correctly
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
								erroresAlta(array('nombre' => $nombre, 'correo'=> $correo, 'carrera' => $carrera, 'codigo' => $codigo, 'contraseña' => $contraseña));
							}
						}//End of ask the user if is a teacher
						else{
							include('Vista/erroresLogueo.php');
							faltaPermisos();
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
								else{
									include('Vista/erroresGrupo.php');
									sinGrupo();
								}
							}
							else{
								include('Vista/listadoAlumno.php');
								grupoIncorrecto();
							}
						}
						else{
							include('Vista/listadoAlumno.php');
							grupoNulo(); //No mando nada
						}
						break;
						//Modificacion de Jesus
						case 'consultar':
						
						if(preg_match("/[A-Za-z]+/", $_POST['accionC'])){ //Validates the action is alphabetic
							switch($_POST['accionC']){
							
								case 'datos'://Info from the student
								if($this->esAlumno()){//This is easy because we already have the student
									$statusMiCarrera = $this->model->consulta(array('esEstudiante'=>true));
									if($statusMiCarrera['acepta']){
									
									}else{
										include('Vista/errorConsulta.php');
										errorConsulta($statusMiCarrera);
									}
								}
								else{
								
								}
								break;
								
								case 'calificaciones'://Grades from the student
								///aqui se consultan las calificaciones y asistencias
								if(isset($_POST['codigo'])){
									$codigoConsulta = $this->verificaCodigo($_POST['codigo']);
								} else{
									$codigoConsulta = false;
								}
								if(isset($_POST['password'])){
									$password = $this->validaPassword($_POST['password']);
								} else{
									$password = false;
								}
								
								$status = $this->model->consulta($codigoConsulta,$password);
									if($status){
										include('Vista/calificacionesAlumno.php');
									} else{
										include('Vista/errorConsulta.php');
									}
								break;
							}
						}
						else{//This is an error
							include('Vista/erroresAlumno.php');
							falloControlador(1);
						}
						break;
						////////////
					}
				}
				else{
					include('Vista/erroresAlumno.php');
					falloControlador(1);
				}
			
			}
			else{
				include('Vista/erroresAlumno.php');
				falloControlador(2);
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
	
	public function validaNombre($cadena){ //Function to validate the syntax of name

		return preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $cadena);

		$cadena = ltrim($cadena);
		$cadena = rtrim($cadena);//We clean the name first
		if(preg_match("/^[A-Za-z\s\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $cadena)){
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
	
	public function validaCodigo($codigo){ //Function to validate the code with a lenght of 9 numbers
		$codigo = ltrim($codigo);
		$codigo = rtrim($codigo);//We clean the code first
		if(preg_match("/^[A-Za-z]?[0-9]{9}/", $codigo))
			return true;
		else
			return -1;
	}
	
	public function validaCarrera($carrera){//Function to validate the career with a number of one or two digits
		$carrera = ltrim($carrera);
		$carrera = rtrim($carrera);//We clean the career first
		if(preg_match("/[0-9]{1,2}/", $carrera))
			return true;
		else
			return -1;
	}
	public function validaURL($url){//Function to validate the url if is corrrect or dont (This function it isnt oblirate
		$url = ltrim($url);
		$url = rtrim($url);//We clean the url first
		if(preg_match("/^((http|https):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $url))
			return true;
		else
			return -1;//If there dont url that means false, but if there an url and its bad then the insertion it gonna be bad.
	}
	
	public function validaGitHub($git){//Function to validate the acoount of Github
		$git = ltrim($git);
		$git = rtrim($git);//We clean the account of git first
		if(preg_match("/^[A-Za-z\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $git))
			return true;
		else
			return -1; //If there dont git that means false, but if there an git and its bad then the insertion it gonna be bad.
	}
	
	public function validaCelular($numero){//Function to validate the syntax of the number of cellphone
		$numero = ltrim($numero);
		$numero = rtrim($numero);//We clean the number first
		if(preg_match("/^(1-9)[0-9]{7}+/", $numero))//It's 7 because we need the first number is great of 0
			return true;
		else
			return -1;//If there dont cellphone number that means false, but if there a number and its bad then the insertion it gonna be bad.
	}
	
	public function validaEquipo($equipo){//Function to validate the name of tean, a team can been an alphabeticnumber
		$equipo = ltrim($equipo);
		$equipo = rtrim($equipo);//We clean the name first
		if(preg_match("/^[A-Za-z0-9\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $equipo))
			return true;
		else
			return -1;//If there dont team that means false, but if there a team and its bad then the insertion it gonna be bad.
	}
	
	public function verificaExistencia($datosObligados){//On this function we return true if the requiremnts are there, if dont we return false
		if($datosObligados['nombre'] === true && $datosObligados['correo'] === true && $datosObligados['carrera'] === false  && $datosObligados['codigo'] === true
		   && $datosObligados['contraseña'] === true){
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
	}//The data is not obligatored but if is there and it's bad then we need to give an error
	
	public function verificaGrupo($grupo){// We return true if the group is correct
		if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$grupo))
			return true;
		else
			return false;
	}

	
	public function validaPassword($password){ // this function validates any character as a password with a lenght between 8 and 50 characters
		if(preg_match("/.{8,50}/"))
		return true;
		else 
			return false;
	}
	// since now any password requires a letter, a number, a special char, a char in another language and a sudoku
	///
}
?>
