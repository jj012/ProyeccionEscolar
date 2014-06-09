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
			$miQuery = "INSERT INTO CURSO VALUES('{$datosCurso['nombre']}', '{$datosCurso['seccion']}', '{$datosCurso['nrc']}', '{$datosCurso['academia']}', {$datosCurso['codigoMaestro']},";
			$miQuery .= "'{$datosCurso['ciclo']}', {$datosCurso['horas']} ) ";
			
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
=======
		
		function clonarCurso($clonarcurso){
			//We access the database and look for the especified course and make and copy those for a new register
			$miQuery = "SELECT * FROM CURSO WHERE NRC = '{$clonarcurso['nrc']}' AND CICLO = '{$clonarcurso['cicloViejo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			
			if($result && $this->bd_driver->affected_rows == 1){//Encontramos el curso, copiamos y cambiamos el valor del ciclo con uno nuevo
				$miQuery = "INSERT INTO CURSO (NOMBRE, SECCION, NRC, ACADEMIA, IDMAESTRO, CICLO, HORAS) ";
				$miQuery .= "VALUES('{$result['nombre']}', '{$result['seccion']}', '{$result['nrc']}', '{$result['academia]}', ";
				$miQuery .= " {$clonarcurso['idmaestro']}, '{$clonarcurso[cicloNuevo]}', {$result['horas']} )";
				
				$resultadoClonado = $this->bd_driver->query($miQuery);
>>>>>>> 3b3bb2d26f1531239043b47b3e4549b99418109a

				if($resultadoClonado && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
				}
				else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}		
			}
			else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $status;

<<<<<<< HEAD
Para los elementos que están marcados:Marcar todosP*/
		

		}

		
		function actualizaAsistencia($datos){
			$miQuery = "UPDATE ASISTENCIA SET VALOR = ${datos['valor']} WHERE ALUMNO_CODIGO = '{$datos['codigoAlumno']}' AND ID_CURSO = {$datos['nrc']}";
			
			
			$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
				}
				else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
				
			return $status;
		}
		
		function insertaAsistencia($datos){//We use this to update the assistences
			$miQuery = "INSERT INTO ASISTENCIA('FECHA','ALUMNO_CODIGO','ID_CODIGO') VALUES( '{$datos['fecha']}', '{$datos['codigoAlumno']}' AND ID_CURSO ={$datos['nrc']}";
			
			
		$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
				}
				else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
		
		}
		function consultarCalificacion($datos){//Falta esta
			if(is_array($datos)){
				$miQuery = "SELECT * FROM CALIFICACION WHERE ALUMNO = '{$datos}'";
				
				$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
				}
				else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
			}else{
				$miQuer = "SELECT * FROM CALIFICACION WHERE ALUMNO = '{$datos['codigo']}' AND N";
			}
			$this->bd_driver->close();
			return $status;

		}
		function consultarAlumnos($datos){//Mystic query D: BE CAREFUL
			$miQuery = "SELECT A.* FROM ALUMNOS A, CURSANDO C, CURSO U WHERE A.CODIGO = C.ALUMNO AND C.CURSO = U.NRC AND U.CICLO = '{$datos['ciclo']}' ";
			$miQuery = " AND U.NRC = '{$datos['ciclo']}' ";
			
			$result = $this->bd_driver->query($miQuery);
			
			
			if($result && $this->bd_driver->affected_rows == 1){
			
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
					
				$status[0] = true;
				$status[1] = $todo[0];
			}
			else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
			$this->bd_driver->close();
			return $status;
		}
		
		function insertaEvaluacion($actividad,$porcentaje){//in case it just evaluates the activity 
			return true;	
		}
		
		function insertaEvaluacionExtra($actividad,$porcentaje,$subactividad,$subporcentaje){//in case the teacher needs an extra page for evaluation
			return true;
		}
		function insertaCalificacion($calificacion){
			$miQuery = "INSERT INTO CALIFICACION VALUES('{$calificacion['calificacion']}', '{$calificacion['codigo']}', {$calificacion['nrc']} ,'{$calificacion['rubro']}')";
			
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
		
		function insertaAsistencia($asistencia){///FALTA
			$miQuery = "INSERT INTO CALIFICACION VALUES('{$calificacion['calificacion']}', '{$calificacion['codigo']}', {$calificacion['nrc']} ,'{$calificacion['rubro']}')";
			
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
    
?>