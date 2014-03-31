<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley AyónJesus Alberto Ley Ayon
	 *  @since 
	 * 
	 */
	require("MdlEstandar.php");
    class MaestroCtrl extends MdlEstandar{
    	public $conexion;
		
		public function __construct(){
		}
		
		function nuevoCurso($datosCurso){//Function to call a query and INSERT into the database
		
			return true;//For the first advance we suppose to think that the data is correct and can been inserted
						 //The next advance we return a false and we call a sql_command to verify if the data can be inserted or not.
		}
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
    }
?>