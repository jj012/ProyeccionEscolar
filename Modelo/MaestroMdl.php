<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley AyónJesus Alberto Ley Ayon
	 *  @since 
	 * 
	 */
	require("MdlEstandar.php");
    class MaestroMdl extends MdlEstandar{
	
		public function __construct(){
			//Create the conection to the database
			require("dbconfig.inc");
			$this->bd_driver = new mysqli($servidor,$usuario,$pass,$bd);
			if($this->bd_driver->connect_errno){
				die("No se pudo conectar porque {$this->bd_driver->connect_error}");
			}
			$this->bd_driver->set_charset("utf8");
		}
		
		function nuevoCurso($datosCurso){//Function to call a query and INSERT into the database
			
			return true;
		}
		/*
			idCurso	int(11)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	2	nombre	varchar(30)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	3	seccion	varchar(45)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	4	nrc	varchar(6)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	5	academia	varchar(45)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	6	Maestro_idMaestro	int(11)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	7	Ciclo_ciclo	char(5)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

	8	horas	int(11)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Único Único
    Índice Índice
    Espacial Espacial
    Más

Para los elementos que están marcados:Marcar todosP*/
		
		
		
		
		
		function clonarCurso($clonarurso){
			//We access the database and look for the especified course and make and copy those for a new register
			return true;
		}
		function consultarAlumno($codigo){
			//Access to the database and look for the code in alumn table if it was found, return the info in a array
			return true;//in this case we assume it was found and return a true
		}
		
		function insertaEvaluacion($actividad,$porcentaje){//in case it just evaluates the activity 
			return true;	
		}
		
		function insertaEvaluacionExtra($actividad,$porcentaje,$subactividad,$subporcentaje){//in case the teacher needs an extra page for evaluation
			return true;
		}
		function insertaCalificacion($calificacion){
			return true;
		}
		function insertaAsistencia($asistencia){
			return true;
		}
		
		function inserta($datos){//INSERT A TEACHER
			$miQuery = "INSERT INTO MAESTRO VALUES(";
			
			$miQuery .= "{$datos['codigo']}, '{$datos['nombre']}', '{$datos['correo']}', '{$datos['contraseña']}')";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$status[0] = true;
			}
			else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $status;
		}
		
		function baja($datos){//"Down" a Teacher";
			$miQuery ="UPDATE MAESTRO SET ESTADO = 0 WHERE idMaestro = {$datos['codigo']}";
			
			$result = $this->bd_driver->query($miQuery);
			if($result && $this->bd_driver->affected_rows == 1){
				$status[0] = true;
			}
			else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $status;
		}
		
		function modifica($datos){//Update the teacher
			$miQuery = "UPDATE MAESTRO SET ";
			
			if(isset($datos['nombre']))
				$miQuery .= "NOMBRE = '{$datos['nombre']}' ,";
			if(isset($datos['correo']))
				$miQuery .= "correoElectronico = '{$datos['nombre']}' ,";
				
			$miQuery = substr($miQuery, 0, strlen($miQuery) - 1);
			
			$miQuery .= "WHERE idMaestro = {$datos['codigo']} ";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$status[0] = true;
			}
			else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $status;	
				
		}
		
		function consulta($datos){
			$miQuery = "SELECT * FROM MAESTRO WHERE idMaestro = '{$datos['codigo']}'";
			$result = $this->bd_driver->query($miQuery);
			$consulta = array();
			if($result && $this->bd_driver->affected_rows == 1){
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
				$consulta[0] = true;
				$consulta[1] = $todo[0];//The result is an array of the consult, in this case will be an array of one student (can be more) so we're going to extract the first register.
			}
			else{
				$consulta[0] = false;
				$consulta[1] = $this->bd_driver->error;
			}
			
			return $consulta;
		
		}
    }
?>