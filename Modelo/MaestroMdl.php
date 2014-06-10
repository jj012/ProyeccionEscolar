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
			$miQuery = "INSERT INTO CURSO (Nombre, Seccion, NRC, ACADEMIA, Maestro_idMaestro, Ciclo_ciclo, horas) ";
			$miQuery .= " VALUES('{$datosCurso['nombre']}', '{$datosCurso['seccion']}', '{$datosCurso['nrc']}', '{$datosCurso['academia']}', ";
			$miQuery .= "{$datosCurso['codigoMaestro']},'{$datosCurso['ciclo']}', {$datosCurso['horas']} ) ";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
			
				//SELECT THIS COURSE
				
				$miQuery2 ="SELECT IDCURSO FROM CURSO WHERE NRC = '{$datosCurso['nrc']}' AND CICLO ='{$datosCurso['ciclo']}'";
				$result = $this->bd_driver->query($miQuery2);
			
				if($result && $this->bd_driver->affected_rows == 1){
					
					$todo = array();
					while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
						$todo[] = $a;
					
					$todo = $todo[0]; //This will be the id
					
						//ADD THE DATES OF CLASSES
					$fechas = $datosCurso['fechas'];
					$status[0] = true;
					$status[2] = $todo['idcurso'];
					foreach($fechas as $fecha){
						$miQuery = "INSERT INTO HORARIO (FECHA,HORAINICIO,Curso_idCurso) values('{$fecha}', ";
						$miQuery .= "'{$datoscurso['horario']}', {$todo['idcurso']} )";
						
						$this->bd_driver->query($miQuery);
						if($this->bd_driver->error !== NULL){
							$status[0] = false;
							$status[1] = $this->bd_driver->error;
							break;
						}
						
					}
					
					foreach($datosCurso['dias'] as $dias){//INSERT DAYS
								$miQuery = "INSERT INTO DIAS VALUES({$dias}, {$todo['idcurso']})";
								$this->bd_driver->query($miQuery);
								if($this->bd_driver->error){
									$status[0] = false;
									$status[1] = $this->bd_driver->error;
									break;
								}
					}
				
				}else{
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

		}
		
		function dameDias($datos){
			$miQuery = "SELECT DIA FROM DIA WHERE CURSO = (SELECT IDCURSO FROM CURSO WHERE CICLO_ciclo= '{$datos['ciclo']}' AND NRC = {$datos['nrc']})";
			
			$result = this->bd_driver->query($miQuery);
			$todo = array();
			while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
				$todo[] = $a;
				
			return $todo;
		}


		function clonarCurso($clonarcurso){
			//We access the database and look for the especified course and make and copy those for a new register
			$miQuery = "SELECT * FROM CURSO WHERE NRC = '{$clonarcurso['nrc']}' AND CICLO = '{$clonarcurso['cicloViejo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			
			if($result && $this->bd_driver->affected_rows == 1){//FIND THE COURSE, COPY AND CHANGE THE CYCLE
				$miQuery = "INSERT INTO CURSO (NOMBRE, SECCION, NRC, ACADEMIA, IDMAESTRO, CICLO, HORAS) ".
				 "VALUES('{$result['nombre']}', '{$result['seccion']}', '{$result['nrc']}', '{$result['academia]}' ".
				 "{$clonarcurso['idmaestro']} , '{$clonarcurso[cicloNuevo]}', {$result['horas']} )";
				
				$resultadoClonado = $this->bd_driver->query($miQuery);

				if($resultadoClonado && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
									//SELECT THIS COURSE
				
				$miQuery2 ="SELECT IDCURSO FROM CURSO WHERE NRC = '{$datosCurso['nrc']}' AND CICLO ='{$datosCurso['ciclo']}'";
				$result = $this->bd_driver->query($miQuery2);
			
				if($result && $this->bd_driver->affected_rows == 1){
					
					$todo = array();
					while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
						$todo[] = $a;
					
					$todo = $todo[0]; //This will be the id
					
						//ADD THE DATES OF CLASSES
					$fechas = $datosCurso['fechas'];
					$status[0] = true;
					$status[2] = $todo['idcurso'];
					foreach($fechas as $fecha){
						$miQuery = "INSERT INTO HORARIO (FECHA,HORAINICIO,Curso_idCurso) values('{$fecha}', ";
						$miQuery .= "'{$datoscurso['horario']}', {$todo['idcurso']} )";
						
						$this->bd_driver->query($miQuery);
						if($this->bd_driver->error !== NULL){
							$status[0] = false;
							$status[1] = $this->bd_driver->error;
							break;
						}
						
					}
					
					foreach($datosCurso['dias'] as $dias){//INSERT DAYS
								$miQuery = "INSERT INTO DIAS VALUES({$dias}, {$todo['idcurso']})";
								$this->bd_driver->query($miQuery);
								if($this->bd_driver->error){
									$status[0] = false;
									$status[1] = $this->bd_driver->error;
									break;
								}
					}
				
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

		}
		
		//Extract the course from the database
		function consultaCurso($datos){
			$miQuery =  "SELECT C.*, H.horaInicio from CURSO C INNER JOIN HORARIO H ON C.idcurso = H.Curso_idcurso ";
			$miQuery .= "WHERE C.NRC = {$datos['nrc']} AND C.CICLO = '{$datos['ciclo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			if($result && $this->bd_driver->affected_rows == 1){
					
					$todo = array();
					while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
						$todo[] = $a;
					
					$status[0] = true;
					$status[1] = $todo;
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
		
			$this->bd_driver->close();
			return $status;
		}
		
		function matricular($arreglo){
			$miQuery = "SELECT IDCURSO FROM CURSO WHERE NRC = {$arreglo['nrc']} AND CICLO_CICLO = '{$arreglo['ciclo']}' ";

			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$status[0] = true;
				//Now with the id we insert the student on this class and give his /her assitances
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
				$todo = $todo[0] //idcurso
				$miQuery = "INSERT INTO CURSANDO (ALUMNO_CODIGO, CURSO_IDCURSO) VALUES('{$arreglo['codigo']}', {$todo['idcurso']})";
				
				$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					//AT LAST WE INSERT THE ASSISTANCES 
					//FIRST GET THE DATES OF CLASS 
					$miQuery = "SELECT FECHA FROM HORARIO WHERE CURSO_IDCURSO = {$todo['idcurso']}";
					
					$result = $this->bd_driver->query($miQuery);
					
					if($result && $this->bd_driver->affected_rows == 1){
						$diasclase = array();
						while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
						$diasclase[] = $a;
						
						//Now insert the assistances
						foreach($diasclase as $dia){
							$miQuery = "INSERT INTO ASISTENCIA(FECHA, ALUMNO_CODIGO, ID_CURSO) VALUES('{$dia}', '{$arreglo['codigo']}', {$todo['idcurso']})";
							$result = $this->bd_driver->query($miQuery);
							
							if(!($result && $this->bd_driver->affected_rows == 1)){
								$status[0] = false;
								$status[1] = $this->bd_driver->error;
								break;
							}
						
						}
					
					}else{
						$status[0] = false;
						$status[1] = $this->bd_driver->error;
					}
					
				}else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
				
			
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
		
			$this->bd_driver->close();
			$return $status;
		
		}
		
		//DELETE FROM THE COURSE
		function bajaCurso($arreglo){
			$miQuery = "SELECT IDCURSO FROM CURSO WHERE NRC = {$arreglo['nrc']} AND CICLO_CICLO = '{$arreglo['ciclo']}' ";

			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				//Now with the id we're going to search his / her class and delete from it
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
				$todo = $todo[0] //idcurso
				$miQuery = "DELETE FROM CURSANDO WHERE ALUMNO_CODIGO = '{$arreglo['codigo']}' AND  CURSO_IDCURSO = {$todo['idcurso']}";
				
				$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
					
				}else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
				
			
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
		
			$this->bd_driver->close();
			$return $status;
		
		}
		
		//Modify the course
		function modificaCurso($arreglo){
			$miQuery = "UPDATE CURSO SET ";
			if(isset($arreglo['nombrecurso']))
				$miQuery .= "nombre = '{$arreglo['nombrecurso']}' ,";
				
			if(isset($arreglo['seccion']))
				$miQuery .= "seccion = '{$arreglo['seccion']}' ,";
			
			if(isset($arreglo['academia']))
				$miQuery .= "academia = '{$arreglo['academia']}' ,";
	
			$miQuery = substr($miQuery, 0, strlen($miQuery) - 1);
			
			$miQuery .= "WHERE NRC = {$arreglo['nrc']} AND CICLO_CICLO = '{$arreglo['ciclo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$status[0] = true;
			
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error:
			}
		
			$this->bd_driver->close();
			$return $status;
		}

		
		function capturaAsistencia($datos){
		
			$miQuery = "SELECT IDCURSO FROM CURSO WHERE NRC = '{$datos['nrc']}' AND CICLO_CICLO = '{$datos['ciclo']}' ";
			
			$result = $this->bd_driver->query($miQuery);
			if($result && $this->bd_driver->affected_rows == 1){
			
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
					
				$todo = $todo[0];//IDCURSO
			
				$miQuery = "UPDATE ASISTENCIA SET VALOR = ${datos['valor']} WHERE ALUMNO_CODIGO = '{$datos['codigo']}' AND ID_CURSO = {$todo['idcurso']}";
				
				
				$result = $this->bd_driver->query($miQuery);
					
					if($result && $this->bd_driver->affected_rows == 1){
						$status[0] = true;
					}
					else{
						$status[0] = false;
						$status[1] = $this->bd_driver->error;
					}
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
				
			$this->bd_driver->close();
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
		
		function fechasCI($ciclo){
			$miQuery = "SELECT * FROM CICLO WHERE CICLO = '{$ciclo}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result){
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
					
				$status = $todo[0];
				
			}else{
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			
				$this->bd_driver->close();
				return $todo;
		}
		
		function insertaEvaluacion($datos){
			$miQuery = "SELECT idcurso from curso where ciclo_ciclo = '{$datos['ciclo']}' and nrc = {$datos['nrc']}";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result){
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
					
				$todo = $todo[0];//idcurso
				
				$miQuery = "INSERT INTO EVALUACION (NOMBRE, PORCENTAJE, CURSO_IDCURSO) VALUES ";
				$miQuery .= "( '{$datos['actividad']}', {$datos['porcentaje']},{$todo['idcurso'] } )";
				$result = $this->bd_driver->query($miQuery);
				
				if($result && $this->bd_driver->affected_rows == 1){
					$status[0] = true;
				}else{
					$status[0] = false;
					$status[1] = $this->bd_driver->error;
				}
			
			}else{
			
				$status[0] = false;
				$status[1] = $this->bd_driver->error;
			}
			$this->bd_driver->close();
			return $status;
		}
		function insertaEvaluacionA($datos){//in case it just evaluates the activity 
			$porcentajes = $datos['porcentajes'];
			foreach($datos['actividades'] as $actividad){
				$miQuery = "INSERT INTO EVALUACION (NOMBRE, PORCENTAJE,CURSO_IDCURSO) VALUES ";
				$miQuery .= " ( '{$actividad}', {$porcentajes[0]}, {$datos['idcurso']})";
				$this->bd_driver->query($miQuery);
				if($this->bd_driver->error){
					return false;
				}
				array_shift($porcentajes);
				if(count($porcentajes) <= 0)
					break;
			}
			$this->bd_driver->close();
			return true;	
		}
		
		function insertaEvaluacionExtra($arreglo){//in case the teacher needs an extra page for evaluation
			$miQuery = "SELECT IDCURSO FROM CURSO WHERE NRC = {$arreglo['nrc']} AND CICLO_CICLO = '{$arreglo['ciclo']}'";
			
			$result = $this->bd_driver->query($miQuery);
			
			if($result && $this->bd_driver->affected_rows == 1){
				$todo = array();
				while($a = $result->fetch_assoc())//fetch_assoc(MYSQL_NUM) OR MYSQL_ASSOC
					$todo[] = $a;
				
				$todo = $todo[0];//idcurso
				$query = "CREATE TABLE {$todo['idcurso']}{$arreglo['actividad']}extra{$arreglo['numExtra']} ";
				$query .="(ID INT AUTO INCREMENT PRIMARY KEY, ";

				for($i = 1; $i <= $_POST['columnas']; $i++){
					$query .= "c{$i} FLOAT ,";
				}
				
				$query = substr($query, 0, strlen($query) - 1);
					
				$query .= ")engine=innodb";

				$this->bd_driver->query($query);

				if($this->bd_driver->errno){
					die("No se pudo crear la tabla");
				}
				$status[0] = true;
			}else{
				$status[0] = false;
			}
			
				$this->bd_driver->close();
				return $status;
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