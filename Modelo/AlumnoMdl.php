<?php
    /**
	 * @author Javier Rizo Orozco & Jesus Alberto Ley Ayon
	 * Model for the user
	 * 
	 * In AlumnoMdl.php we made all the conections to the database define the rules and relations
	 * the methods here are invoked through @see AlumnoCtrl.php
	 * 
	 */
	 require("MdlEstandar.php");
	 class AlumnoModel extends MdlEstandar{
		
		function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($this->bd_driver->connect_errno){
				die("No se pudo conectar porque {$this->bd_driver->connect_error}");
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
		}*/
		
		function insertaAlumno($datosAlumno){//Function to call a query and INSERT into the database
			$miQuery = "INSERT INTO ALUMNO VALUES ('{$datosAlumno['codigo']}',".
						"'{$datosAlumno['nombre']}',{$datosAlumno['carrera']},'{$datosAlumno['correo']}'";
			if($datosAlumno['celular'] !== false)
				$miQuery .= ",{$datosAlumno['celular']}";
			else
				$miQuery .= ",null";
			if($datosAlumno['git'] !== false)
				$miQuery .= ",'{$datosAlumno['git']}'";
			else
				$miQuery .= ",null";
			if($datosAlumno['url'] !== false)
				$miQuery .= ",'{$datosAlumno['url']}'";
			else
				$miQuery .= ",null";
						
			$miQuery .= ",1, '{$datosAlumno['contraseña']}')";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result){
				$alta = array(true, $result);
			}else{
				$alta = array(-1,$result); //Regresamos que fue un error y aparte enviamos el mensaje de errir
			}
			
			$this->bd_driver->close();
			return $alta;
		}
		

		function consulta($datos){
			if($datos['esEstudiante']){
				$myQuery = "SELECT * FROM ALUMNO WHERE CODIGO = '{$_SESSION['user']}'";
				$result = $this->bd_driver->query($miQuery);
			}
 		}
 		
 		
		function baja($codigo){//Function to call a query with UPDATE into the database
			$miQuery = "UPDATE ALUMNO SET ESTADO = 0 WHERE CODIGO = '{$codigo}';";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$baja = array(true, $result);
			}else{
				$baja = array(-1,$this->bd_driver->error); //Regresamos que fue un error y aparte enviamos el mensaje de errir
			}
			
			$this->bd_driver->close();
			return $baja;
		}
		
		///Modificacion de Jesus
		function consultaAlumno($codigo){

			return true;//For the first advance we suppose that the data is correct and can access to the database
						
		}
		
	 }
	 
?>
0