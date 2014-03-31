<?php
    /**
	 * @author Javier Rizo Orozco & Jesus Alberto Ley Ayon
	 * Model for the user
	 * 
	 * In AlumnoMdl.php we made all the conections to the database define the rules and relations
	 * the methods here are invoked through @see AlumnoCtrl.php
	 * 
	 */
	|require("MdlEstandar.php");
	 class AlumnoModel extends MdlEstandar{
	 	public $bd_driver;
		
		function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($bd_driver->connect_errno){
				die("No se pudo conectar porque {$bd_driver->connect_error}");
			}
		}
		
		function listar(){
			$miQuery = "SELECT * FROM ALUMNO";
			$result = $this->bd_driver->query($miQuery);
			
			
			//Buscar error antes de extraer
			
			//Realiza todo :_:
			$todo[] = array();
			while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
				$todo[] = $a;
			return $todo;
		
		}
		
		/**function listar($grupo){ //Consult the group, return the array with the group and status with true, if dont then only return the array with status false
			if($grupo == "CC403-D05")
				$lista =  array('status'=>true, "Juanito", "Fulanito", "Pepito", "Marianita", "Carlos");
			else if($grupo == "i4214-D04")
				$lista = array('status'=>true, "Mariano", "Lalo", "Zara", "Karlita", "Liz");
			else
				$lista = array('status'=>false);
				return $lista;
		}*//
		
		function insertaAlumno($datosAlumno){//Function to call a query and INSERT into the database
			$myQuery = "INSERT INTO 'alumno'('codigo', 'nombre', 'carrera', 'correoElectronico', 'celular',
						'cuentaGit', 'paginaWeb', 'estado', 'contraseña') VALUES ('$datosAlumno['codigo']',
						'$datosAlumno['nombre']',$datosAlumno['carrera'],'$datosAlumno['correo']'";
						
			if($datosAlumno['celular'] !== false)
				$myQuery .= ",$datosAlumno['celular']";
			else
				$myQuery .= ",null";
			if($datosAlumno['git'] !== false)
				$myQuery .= ",'$datosAlumno['git']'";
			else
				$myQuery .= ",null";
			if($datosAlumno['url'] !== false)
				$myQuery .= ",'$datosAlumno['url']'";
			else
				$myQuery .= ",null";
						
			$myQuery .= ",1, '$datosAlumno['contraseña'])'";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result){
				$alta = array(true, $result);
			}else{
				$alta = array(-1,$result); //Regresamos que fue un error y aparte enviamos el mensaje de errir
			}
			
			$this->cierraConexion();
			return $alta; 
		}
		

		function consulta($codigo,$password){
 		return true;
 		}
 		
 		
		function baja($codigo){//Function to call a query with UPDATE into the database
		
			return true;//For the first advance we suppose to think that the code is correct and the studen its down
		}
		
		///Modificacion de Jesus
		function consultar($codigo){

			return true;//For the first advance we suppose that the data is correct and can access to the database
						
		}
		
	 }
	 
?>
